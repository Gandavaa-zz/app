<?php

namespace App\Http\Controllers;

use App\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
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

    //report iin layout hevlej baina
    public function getHtml($assessment_id)
    {
        $data = array();
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
                foreach ($value["domaines"]["domaine"] as $domains) {

                    if (is_array($domains["cibles_secondaires"]["cibles_secondaire"])) {
                        foreach ($domains["cibles_secondaires"]["cibles_secondaire"] as $secondary_target) {
                            // dd($domains["cibles_secondaires"]["cibles_secondaire"]);
                            $comments[]  = [
                                'color' => isset($secondary_target["color"]) ? $secondary_target["color"] : null,
                                "score" =>  isset($secondary_target["score"]) ? $secondary_target["score"] : 0,
                                "comment" =>  $this->getMNText(isset($secondary_target["contenus"]["contenu"]["commentaire_perso"]) ? $secondary_target["contenus"]["contenu"]["commentaire_perso"] : null),
                            ];
                        }
                    }
                    $domain[] = [
                        'id' => $domains["@attributes"]["id"],
                        'label' => $this->getMNText($domains["contenus"]["contenu"]["libelle"]),
                        "contents" =>  $comments
                    ];
                    unset($comments);
                }
            }
            $party["party"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'type' =>  $value["@attributes"]["type"],
                    'params' =>  $value['params'],
                    'content' => array(
                        'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                        'title' => $this->getMNText($value["contenus"]["contenu"]["titre"]),
                        'sub_title' => $this->getMNText(isset($value["contenus"]["contenu"]["sous_titre"]) ? $value["contenus"]["contenu"]["sous_titre"] : null),
                        'description_long' => $this->getMNText(isset($value["contenus"]["contenu"]["description_long"]) ? $value["contenus"]["contenu"]["description_long"] : null),
                        'description' => $this->getMNText(isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null),
                        'introduction' => $this->getMNText(isset($value["contenus"]["contenu"]["introduction"]) ? $value["contenus"]["contenu"]["introduction"] : null),
                        'description_courte' => $this->getMNText(isset($value["contenus"]["contenu"]["description_courte"]) ? $value["contenus"]["contenu"]["description_courte"] : null),
                        'domain'  => $this->getMNText(isset($domain) ? $domain : [])
                    )
                ];
            unset($domain);
            //setting all values to variable $data
            $data["parties"] = $party;
        }
        // $data = $this->JSONMapper($data);
        // dd($data);
        return view('layouts.reports.index', compact('data'));
    }

    public function getMNText($str)
    {

        // dd($str);
        $text = Translation::select('MN')->where('EN', '=', $str)->value("MN");
        // dd($text);
        if (!$text) {
            return $str;
        }
        //db ruu duudaj hargalzah text-g bucaana

        return $text;
    }

    public function getXml($assessment_id = null, $test_id = null)
    {
        // print_r($encrypted);
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
        // RIASEC report
        // foreach($xml['elements']['test_groupe_facteurs']['test_groupe_facteur'] as $value){
        //     print_r($value);
        //     echo "<br>";
        // }
        // get test factor results done
        // foreach($xml['elements']['test_facteurs']['test_facteur'] as $value){
        //     echo $value["@attributes"]["score_brut"];
        //     echo "<br>";
        // }

        // COMBINED PROFILES FROM HOLLAND TYPOLOGY
        // foreach($xml['elements']['rapport_adequation_profils']['rapport_adequation_profil'] as $value){
        //     echo $value["@attributes"]["score_calcule"];
        //     echo "<br>";
        // }

        // parties
        // 1
        // titre: Graph
        // sous-titre: "Results on the factors "
        // $parties  = collect($xml['parties']['partie']);

        // foreach( $parties as $data){
        //     print_r($data['contenus']);
        // }

        // return $parties_data;
        // return $parties_data->contains('@attributes');
        // return $xml['elements']['rapport_adequation_profils'];
        // return $xml['elements']['test_facteurs'];
        // foreach ($xml as $key => $value) {
        //     echo $key;
        // }
    }
}
