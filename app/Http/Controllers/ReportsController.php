<?php

namespace App\Http\Controllers;


use App\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportsController extends Controller
{

    protected $participant ='';

    protected $data = array();

    public function result($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get(
            'https://app.centraltest.com/customer/REST/assessment/result/xml',
            [
                'id' => $assessment_id,
            ]
        );

        return $response;
    }

    function global($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->post(
            'https://app.centraltest.com/customer/REST/report/score/json',
            [
                'id' => $assessment_id,
            ]
        );
        return $response;
    }

    public function factory($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get(
            'https://app.centraltest.com/customer/REST/report/factors_scores/json',
            [
                'assessment_id' => $assessment_id,
            ]
        );

        return $response;
    }

    public function groups($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->post(
            'https://app.centraltest.com/customer/REST/report/groups_score/json',
            [
                'assessment_id' => $assessment_id,
            ]
        );

        return $response;
    }

    public function referential($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get(
            'https://app.centraltest.com/customer/REST/assessment/referentials/json',
            [
                'id' => $assessment_id,
            ]
        );

        return $response;
    }

    /*
        Report-г дуудаж харуулна.
    */
    public function getHtml($assessment_id)
    {
        if (!Storage::exists("/assets/assessments/{$assessment_id}.xml")) {

            $response = Http::withHeaders([
                'WWW-Authenticate' => $this->token,
            ])->get(
                'https://app.centraltest.com/customer/REST/assessment/result/xml',
                [
                    'id' => $assessment_id,
                    'language_id' => "1",
                ]
            );
            // $encrypted = Crypt::encryptString($response);
            Storage::put("/assets/assessments/{$assessment_id}.xml", $response);
        }

        $contents = Storage::get("assets/assessments/{$assessment_id}.xml");
        $content = array();
        $domain = array();
        $party = array();
        $comments = array();
        $xml = xml_decode($contents);

        // return $xml;
        // general
        $data['general'] = [
            'test_id' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["id"],
            'score' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_calcule"],
            'score_brut' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_brut"],
            'logo' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["logo3"],
            'label' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["libelle"],
            'participant_name' => $xml["noyau_utilisateur_info"]["nom"] . " " . $xml["noyau_utilisateur_info"]["prenom"],
            'passed_date' =>$xml['params']['date_passation_fin']
        ];

        $this->participant = $data['general']['participant_name'];

        // test_facteur
        foreach ($xml['elements']['test_facteurs']['test_facteur'] as $value) {
            $data['test_factors'][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'score' => $value["@attributes"]["score_brut"],
                    'score_calc' => $value["@attributes"]["score_calcule"],
                    'color' => $value["couleur"],
                    'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                ];
        }
        // test_groupe_facteur
        foreach ($xml['elements']['test_groupe_facteurs']['test_groupe_facteur'] as $value) {
            $data["test_group_factors"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'score' => $value["@attributes"]["score_brut"],
                    'color' => $value["couleur"],
                    'score_calc' => $value["@attributes"]["score_calcule"],
                    'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                ];
        }
        // test_ref_adequation_profil
        foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $value) {
            $data["test_group_factors"] =
                [
                    'id' => $value["@attributes"]["id"],
                    'label' => $value["contenus"]["contenu"]["libelle"],
                    'description' => $this->getMNText(isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null),
                    'description_long' => $this->getMNText(isset($value["contenus"]["contenu"]["description_long"]) ? $value["contenus"]["contenu"]["description_longue"] : null),

                ];
        }
        // test_mini_tests
        $data['test_mini_tests'] = [
            'id' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["id"],
            'score' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["score_calcule"],
        ];
        // parties
        foreach ($xml['parties']['partie'] as $value) {

            if (isset($value["domaines"]["domaine"])) {

                foreach ($value["domaines"] as $domains) {

                    if (isset($domains["cibles_secondaires"]) && is_array($domains["cibles_secondaires"]["cibles_secondaire"])) {

                        foreach ($domains["cibles_secondaires"] as $secondary_target) {

                            $comments  = [
                                'color' => isset($secondary_target["color"]) ? $secondary_target["color"] : null,
                                "score" =>  isset($secondary_target["score"]) ? $secondary_target["score"] : 0,
                                "comment" =>  $this->getMNText(isset($secondary_target["contenus"]["contenu"]["commentaire_perso"]) ? $secondary_target["contenus"]["contenu"]["commentaire_perso"] : null),
                            ];
                        }
                    }
                    if (isset( $domains["@attributes"])){
                        $domain = [
                            'id' => $domains["@attributes"]["id"],
                            'label' => $this->getMNText($domains["contenus"]["contenu"]["libelle"]),
                            "contents" =>  $comments
                        ];
                        unset($comments);
                    }
                }
            }
            $adequates = [];
            if (isset($value['rapport_adequation_classes'])
                && isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']) ) {
                foreach ($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil'] as $adequate) {
                    $adequates[] = array(
                        'pourcentage_score' => isset($adequate['pourcentage_score']) ? $adequate['pourcentage_score'] : null,
                        'score' => isset($adequate['score']) ? $adequate['score'] : null,
                        'color' => isset($adequate['couleur_classe']) ? $adequate['couleur_classe'] : null,
                    );
                    // dd($adequates);
                }
            }
            // dd($adequates);
            $party["party"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'type' =>  $value["@attributes"]["type"],
                    'params' =>  $value['params'],
                    'content' => array(
                        'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                        'title' => $this->getMNText($value["contenus"]["contenu"]["titre"]),
                        'sub_title' => $this->getMNText(isset($value["contenus"]["contenu"]["sous_titre"]) ? $value["contenus"]["contenu"]["sous_titre"] : null),
                        'description_long' => $this->getMNText(isset($value["contenus"]["contenu"]["description_longue"]) ? $value["contenus"]["contenu"]["description_longue"] : null),
                        'description' => $this->getMNText(isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null),
                        'introduction' => $this->getMNText(isset($value["contenus"]["contenu"]["introduction"]) ? $value["contenus"]["contenu"]["introduction"] : null),
                        'description_courte' => $this->getMNText(isset($value["contenus"]["contenu"]["description_courte"]) ? $value["contenus"]["contenu"]["description_courte"] : null),
                        'domain'  => $this->getMNText(isset($domain) ? $domain : []),
                        'label_group'  => array_key_exists('libelle_groupe_opposition', $value["contenus"]["contenu"]
                        ),
                        'commentaire_perso' => $this->getMNText(isset($value["contenus"]["contenu"]["commentaire_perso"]) ? $value["contenus"]["contenu"]["commentaire_perso"] : null),
                    ),
                    // 'adequacy' => array(
                    //     'pourcentage_score' => isset($value["rapport_adequation_classes"]) ? ($this->getMNText($value["rapport_adequation_classes"]["rapport_adequation_classe"]["rapport_adequation_profils"]["rapport_adequation_profil"]["pourcentage_score"]) ?  $value["rapport_adequation_classes"]["rapport_adequation_classe"]["rapport_adequation_profils"]["rapport_adequation_profil"]["pourcentage_score"] : null) : null
                    // )
                ];

            unset($domain);
            //setting all values to variable $data
            $data["parties"] = $party;
        }
        //return $data;
        // return $data;

        // $data = $this->JSONMapper($data);
        return view('layouts.reports.'.$data['general']['test_id'], compact('data'));
    }

    public function getMNText($str)
    {
        // before find text replace user name by $participant

         if(is_array($str)){

            if(sizeof($str)>0)
                $str = implode('', $str);
            else
                $str ='';
         }
            $var = "'s";
            $string = Str::replaceFirst($this->participant, '$', $str);
            $newparticipant = $this->participant .  $var;
            $replaced = Str::replaceFirst($newparticipant, '$', $string);

            $text = Translation::select('MN')->where('EN', '=', $replaced)->value("MN");

            // dd($text);
            if (!$text) {
                return $text;
            }

            return $str;
        // }
        // $position = strpos($str, $participant);
        // echo $position;
        //db ruu duudaj hargalzah text-g bucaana

    }

    // getdata
    public function getData($assessment_id){

        $contents = Storage::get("assets/assessments/{$assessment_id}.xml");
        $content = array();
        $domain = array();
        $party = array();
        $comments = array();
        $xml = xml_decode($contents);

        // general
        $data['general'] = [
            'test_id' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["id"],
            'score' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_calcule"],
            'score_brut' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_brut"],
            'logo' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["logo3"],
            'label' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["libelle"],
            'participant_name' => $xml["noyau_utilisateur_info"]["nom"] . " " . $xml["noyau_utilisateur_info"]["prenom"],
            'passed_date' =>$xml['params']['date_passation_fin']
        ];
        // test_facteur
        foreach ($xml['elements']['test_facteurs']['test_facteur'] as $value) {
            $data['test_factors'][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'score' => $value["@attributes"]["score_brut"],
                    'score_calc' => $value["@attributes"]["score_calcule"],
                    'color' => $value["couleur"],
                    'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                ];
        }
        // test_groupe_facteur
        foreach ($xml['elements']['test_groupe_facteurs']['test_groupe_facteur'] as $value) {
            $data["test_group_factors"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'score' => $value["@attributes"]["score_brut"],
                    'color' => $value["couleur"],
                    'score_calc' => $value["@attributes"]["score_calcule"],
                    'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                ];
        }
        // test_ref_adequation_profil
        foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $value) {
            $data["test_group_factors"] =
                [
                    'id' => $value["@attributes"]["id"],
                    'label' => $value["contenus"]["contenu"]["libelle"],
                    'description' => $this->getMNText(isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null),
                    'description_long' => $this->getMNText(isset($value["contenus"]["contenu"]["libelle"]) ? $value["contenus"]["contenu"]["description_longue"] : null),
                ];
        }
        // test_mini_tests
        $data['test_mini_tests'] = [
            'id' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["id"],
            'score' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["score_calcule"],
        ];
        // parties
        foreach ($xml['parties']['partie'] as $value) {
            if (isset($value["domaines"]["domaine"])) {
                foreach ($value["domaines"] as $domains) {
                    if (isset($domains["cibles_secondaires"]) && is_array($domains["cibles_secondaires"]["cibles_secondaire"])) {
                        foreach ($domains["cibles_secondaires"] as $secondary_target) {
                            // dd($domains["cibles_secondaires"]["cibles_secondaire"]);
                            $comments[]  = [
                                'color' => isset($secondary_target["color"]) ? $secondary_target["color"] : null,
                                "score" =>  isset($secondary_target["score"]) ? $secondary_target["score"] : 0,
                                "comment" =>  $this->getMNText(isset($secondary_target["contenus"]["contenu"]["commentaire_perso"]) ? $secondary_target["contenus"]["contenu"]["commentaire_perso"] : null),
                            ];
                        }
                    }
                    if (isset( $domains["@attributes"])){
                        $domain[] = [
                            'id' => $domains["@attributes"]["id"],
                            'label' => $this->getMNText($domains["contenus"]["contenu"]["libelle"]),
                            "contents" =>  $comments
                        ];
                        unset($comments);
                    }
                }
            }
            $adequates = [];
            if (isset($value['rapport_adequation_classes'])
                && isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']) ) {
                foreach ($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil'] as $adequate) {
                    $adequates[] = array(
                        'pourcentage_score' => isset($adequate['pourcentage_score']) ? $adequate['pourcentage_score'] : null,
                        'score' => isset($adequate['score']) ? $adequate['score'] : null,
                        'color' => isset($adequate['couleur_classe']) ? $adequate['couleur_classe'] : null,
                    );
                    // dd($adequates);
                }
            }
            // dd($adequates);
            $party["party"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'type' =>  $value["@attributes"]["type"],
                    'params' =>  $value['params'],
                    'content' => array(
                        'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                        'title' => $this->getMNText($value["contenus"]["contenu"]["titre"]),
                        'sub_title' => $this->getMNText(isset($value["contenus"]["contenu"]["sous_titre"]) ? $value["contenus"]["contenu"]["sous_titre"] : null),
                        'description_long' => $this->getMNText(isset($value["contenus"]["contenu"]["description_longue"]) ? $value["contenus"]["contenu"]["description_longue"] : null),
                        'description' => $this->getMNText(isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null),
                        'introduction' => $this->getMNText(isset($value["contenus"]["contenu"]["introduction"]) ? $value["contenus"]["contenu"]["introduction"] : null),
                        'description_courte' => $this->getMNText(isset($value["contenus"]["contenu"]["description_courte"]) ? $value["contenus"]["contenu"]["description_courte"] : null),
                        'domain'  => $this->getMNText(isset($domain) ? $domain : []),
                        'label_group'  => array_key_exists('libelle_groupe_opposition', $value["contenus"]["contenu"]),
                        'commentaire_perso' => $this->getMNText(isset($value["contenus"]["contenu"]["commentaire_perso"]) ? $value["contenus"]["contenu"]["commentaire_perso"] : null)
                    ),
                ];

            unset($domain);
            //setting all values to variable $data
            $data["parties"] = $party;
        }
        return $data;
    }

    public function getXml($assessment_id = null, $test_id = null)
    {
        if (Storage::exists("/assets/assessments/{$assessment_id}.xml")) {
            // $contents = Storage::get("assets/assessments/{$assessment_id}.xml");
            // $decrypted= Crypt::decryptString($contents);
            // $xml = xml_decode($contents);
            return redirect()->route('assessment.index', "test_id={$test_id}")->with('success', 'XML татагдсан байна');
        } else {
            $response = Http::withHeaders([
                'WWW-Authenticate' => $this->token,
            ])->get(
                'https://app.centraltest.com/customer/REST/assessment/result/xml',
                [
                    'id' => $assessment_id,
                    'language_id' => "1",
                ]
            );
            // $encrypted = Crypt::encryptString($response);
            Storage::put("/assets/assessments/{$assessment_id}.xml", $response);
            Storage::put("/assets/tests/{$test_id}/$assessment_id.xml", $response);

            return redirect()->route('assessment.index', "test_id={$test_id}")->with('success', 'XML амжилттай татагдлаа!');
        }
    }
}
