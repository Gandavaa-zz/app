<?php

namespace App\Http\Controllers;


use App\Translation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DateTime;
use Illuminate\Support\Facades\DB;
use \PDF;

class ReportsController extends Controller
{

    protected $participant = '';

    protected $data = array();

    public function generatePDF()
    {

        $data = $this->getHtml(9842513);
        // $data = $data;
        // dd($data);
        $pdf = PDF::loadView('layouts.reports.318', array('data' => $data->data))->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->stream('report.pdf');
    }


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
        $content = $domain = $party = $comments = array();
        $xml = xml_decode($contents);
        $candidate_name = $xml["noyau_utilisateur_info"]["prenom"] . " " . $xml["noyau_utilisateur_info"]["nom"];
        $xml = $this->replaceName($candidate_name, json_encode($xml));
        // general
        $xml = json_decode($xml, true);
        // dd($xml);
        $started_at = new DateTime($xml['params']['date_passation_debut']);
        $completed_at = new DateTime($xml['params']['date_passation_fin']);
        $passed_dt = $started_at->diff($completed_at);
        $year = date('Y', strtotime($xml['params']['date_passation_debut']));
        $day = date('d', strtotime($xml['params']['date_passation_debut']));
        $month = date('m', strtotime($xml['params']['date_passation_debut']));
        $hour = $passed_dt->h; //getting hour
        $minute = $passed_dt->i; //getting minute
        $second = $passed_dt->s; //getting minute
        $test_date = "Тестийг $year оны $month-р сарын $day-нд $minute минут $second секундэд гүйцэтгэсэн";

        $data['general'] = [
            'test_id' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["id"],
            'score' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_calcule"],
            'client' => $xml['params']['client_societe'],
            'score_brut' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_brut"],
            'logo' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["logo3"],
            'label' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["libelle"],
            'participant_name' => $this->getMNText($candidate_name),
            'completed_at' => $test_date
        ];

        $this->participant = $data['general']['participant_name'];
        // test_groupe_facteur
        $factor = [];
        foreach ($xml['elements']['test_groupe_facteurs']['test_groupe_facteur'] as $value) {
            // test_facteur
            foreach ($xml['elements']['test_facteurs']['test_facteur'] as $factors) {
                $data['test_factors'][] =
                    [
                        'id' => $factors["@attributes"]["id"],
                        'label' => $this->getMNText($factors["contenus"]["contenu"]["libelle"]),
                        'score' => $factors["@attributes"]["score_brut"],
                        'score_calc' => $factors["@attributes"]["score_calcule"],
                        'group_id' => $factors["@attributes"]["test_groupe_facteur_id"],
                        'color' => $factors["couleur"],

                    ];

                if ($factors["@attributes"]["test_groupe_facteur_id"] == $value["@attributes"]["id"]) {

                    $description = "";
                    $description_courte_opposition = "";
                    foreach ($xml['parties']['partie'] as $row) {
                        // dd($row, $factors);
                        if ($row['@attributes']['type'] == 'rapport_details_facteur' && ($row['contenus']['contenu']['titre'] == $factors["contenus"]["contenu"]["libelle"] || $row['contenus']['contenu']['libelle_facteur'] == $factors["contenus"]["contenu"]["libelle"])) {

                            $description = $row['contenus']['contenu']['description_courte'];
                            $description_courte_opposition = $row['contenus']['contenu']['description_courte_opposition'];
                        }
                    }
                    // dd($description);
                    $factor[] = [
                        'id' => $factors["@attributes"]["id"],
                        'score' => $factors["@attributes"]["score_brut"],
                        'score_calc' => $factors["@attributes"]["score_calcule"],
                        'description' => $this->getMNText($description),
                        'description_opposite' => $this->getMNText($description_courte_opposition),
                        'group_id' => $factors["@attributes"]["test_groupe_facteur_id"],
                        'opposed_id' => $factors["@attributes"]["test_facteur_oppose_id"],
                        'color' => $factors["couleur"],
                        'label' => $this->getMNText($factors["contenus"]["contenu"]["libelle"]),
                    ];
                    $description = "";
                }
            }

            $data["group_factors"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'score' => $value["@attributes"]["score_brut"],
                    'color' => $value["couleur"],
                    'score_calc' => $value["@attributes"]["score_calcule"],
                    'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                    'factors' => $factor
                ];
            unset($factor);
        }
        // dd($data);
        // test_mini_tests
        $data['test_mini_tests'] = [
            'id' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["id"],
            'score' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["score_calcule"],
        ];

        // parties
        $label = "";
        foreach ($xml['parties']['partie'] as $value) {

            if (isset($value["domaines"]["domaine"])) {
                if (isset($value["domaines"]["domaine"]['@attributes'])) {
                    if (isset($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire']['@attributes'])) {

                        $comments[] = [
                            'color' => isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]['color']) ? $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]['color'] : null,
                            "score" =>  isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["score"]) ? $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["score"] : 0,
                            "title" =>  $this->getMNText(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"] : null),
                            "comment" =>  $this->getMNText(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"] : null),
                        ];
                        if (isset($comments)) {
                            $domain[] = [
                                'id' => isset($value["domaines"]["domaine"]["@attributes"]["id"]) ? $value["domaines"]["domaine"]["@attributes"]["id"] : null,
                                'label' => isset($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) ? $this->getMNText($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) : null,
                                "contents" =>  $comments
                            ];

                            unset($comments);
                        }
                    } else {

                        if (isset($value["domaines"]["domaine"]['cibles_secondaires'])) {

                            foreach ($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire'] as $item) {
                                if (isset($item['@attributes']["target_id"])) {
                                    foreach ($data['test_factors'] as $test_factor) {
                                        if ($item['@attributes']["target_id"] == $test_factor['id'])
                                            $label = $test_factor['label'];
                                    }
                                }
                            }
                            $comments[]  = [
                                'color' => isset($item["color"]) ? $item["color"] : null,
                                "score" =>  isset($item["score"]) ? $item["score"] : 0,
                                "title" => $label,
                                "comment" =>  $this->getMNText(isset($item["contenus"]["contenu"]["commentaire_perso"]) ? $item["contenus"]["contenu"]["commentaire_perso"] : null),
                            ];
                            if (isset($comments)) {
                                $domain[] = [
                                    'id' => isset($value["domaines"]["domaine"]["@attributes"]["id"]) ? $value["domaines"]["domaine"]["@attributes"]["id"] : null,
                                    'label' => isset($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) ? $this->getMNText($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) : null,
                                    "contents" =>  $comments
                                ];
                                if (isset($comments)) {
                                    $domain[] = [
                                        'id' => isset($item["@attributes"]["id"]) ? $item["@attributes"]["id"] : null,
                                        'label' => isset($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) ? $this->getMNText($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) : null,
                                        isset($item["contenus"]["contenu"]["libelle"]) ? $this->getMNText($item["contenus"]["contenu"]["libelle"]) : null,
                                        "contents" =>  $comments
                                    ];

                                    unset($comments);
                                }
                            }
                        }
                    }
                } else {

                    if (isset($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire']['@attributes'])) {

                        $comments[]  = [
                            'target_id' => isset($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire']['@attributes']["target_id"]) ? $value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire']['@attributes']["target_id"] : 0,
                            'color' => isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]['color']) ? $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]['color'] : null,
                            "score" =>  isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["score"]) ? $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["score"] : 0,
                            "title" =>  $this->getMNText(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"] : null),
                            "comment" =>  $this->getMNText(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"] : null),
                        ];
                        if (isset($comments)) {
                            $domain[] = [
                                'id' => isset($value["domaines"]["domaine"]["@attributes"]["id"]) ? $value["domaines"]["domaine"]["@attributes"]["id"] : null,
                                'label' => isset($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) ? $this->getMNText($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) : null,
                                "contents" =>  $comments
                            ];

                            unset($comments);
                        }
                    } else {

                        foreach ($value["domaines"]["domaine"] as $item) {

                            if (isset($item['cibles_secondaires']['cibles_secondaire']['@attributes'])) {

                                $comments[] = [
                                    'color' => isset($item["cibles_secondaires"]["cibles_secondaire"]['color']) ? $item["cibles_secondaires"]["cibles_secondaire"]['color'] : null,
                                    "score" =>  isset($item["cibles_secondaires"]["cibles_secondaire"]["score"]) ? $item["cibles_secondaires"]["cibles_secondaire"]["score"] : 0,
                                    "title" =>  $this->getMNText(isset($item["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"]) ?
                                        $item["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"] : null),
                                    "comment" =>  $this->getMNText(isset($item["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"]) ?
                                        $item["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"] : null),
                                ];
                                if (isset($comments)) {
                                    $domain[] = [
                                        'id' => isset($item["@attributes"]["id"]) ? $item["@attributes"]["id"] : null,
                                        'label' => isset($item["contenus"]["contenu"]["libelle"]) ? $this->getMNText($item["contenus"]["contenu"]["libelle"]) : null,
                                        "contents" =>  $comments
                                    ];

                                    unset($comments);
                                }
                            } else {
                                // print_r("2, ");
                                // dd($item['cibles_secondaires']['cibles_secondaire']);
                                if (isset($item['cibles_secondaires']['cibles_secondaire']))
                                    foreach ($item['cibles_secondaires']['cibles_secondaire'] as $row) {
                                        if (isset($row['@attributes']["target_id"])) {
                                            foreach ($data['test_factors'] as $test_factor) {
                                                if ($row['@attributes']["target_id"] == $test_factor['id'])
                                                    $label = $test_factor['label'];
                                            }
                                        }

                                        $comments[]  = [
                                            'color' => isset($row["color"]) ? $row["color"] : null,
                                            "score" =>  isset($row["score"]) ? $row["score"] : 0,
                                            "title" => $label,
                                            "comment" =>  $this->getMNText(isset($row["contenus"]["contenu"]["commentaire_perso"]) ? $row["contenus"]["contenu"]["commentaire_perso"] : null),
                                        ];
                                    }
                            }
                            if (isset($comments)) {
                                $domain[] = [
                                    'id' => isset($item["@attributes"]["id"]) ? $item["@attributes"]["id"] : null,
                                    'label' => isset($item["contenus"]["contenu"]["libelle"]) ? $this->getMNText($item["contenus"]["contenu"]["libelle"]) : null,
                                    "contents" =>  $comments
                                ];

                                unset($comments);
                            }
                        }
                    }
                }
                // dd($comments);
                // dd($domain);
            }

            $adequates = [];
            $test_ref_adequation = [];
            $rapport_class = [];
            if (isset($value['rapport_adequation_classes'])) {
                if (isset($value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes'])) {
                    if (isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes'])) {
                        // print_r("rapport_adequation_classes >  profile object");
                        if (isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes'])) {
                            $adequates   = [
                                'id' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['id']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['id'] : null,
                                'pourcentage_score' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score'] : null,
                                'score' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['score']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['score'] : null,
                                'color' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['couleur_classe']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['couleur_classe'] : null,
                                'test_ref_adequation' => isset($test_ref_adequation) ? $test_ref_adequation : [],
                            ];
                            unset($test_ref_adequation);
                        } else {
                            $class_id = isset($value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes']['test_ref_adequation_classe_id']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes']['test_ref_adequation_classe_id'] : 0;
                            // print_r("rapport_adequation_classes object and profile array");
                            dd($value['rapport_adequation_classes']['rapport_adequation_classe']);
                            foreach ($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil'] as $adequate) {
                                foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {
                                    $id = isset($adequate['@attributes']['test_ref_adequation_profil_id']) ? $adequate['@attributes']['test_ref_adequation_profil_id'] : 0;
                                    if ($id == $test_ref["@attributes"]["id"]) {

                                        $test_ref_adequation =
                                            [
                                                'id' => $test_ref["@attributes"]["id"],
                                                'label' => $test_ref["contenus"]["contenu"]["libelle"],
                                                'description' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description"]) ? $test_ref["contenus"]["contenu"]["description"] : null),
                                                'description_long' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null),

                                            ];
                                    }
                                }
                                // test_classes
                                foreach ($xml['elements']['test_ref_adequation_classes']['test_ref_adequation_classe'] as $class) {
                                    if ($class['@attributes']['id'] == $class_id) {
                                        $rapport_class[] = [
                                            "label" => $class['contenus']['contenu']['libelle'],
                                            "description" => $class['contenus']['contenu']['description'],
                                            "description_long" => $class['contenus']['contenu']['description_longue'],
                                            'test_ref_adequation' => isset($test_ref_adequation) ? $test_ref_adequation : [],
                                        ];
                                    }
                                }
                                $adequates[] = [
                                    'id' => isset($adequate['@attributes']) ? $adequate['@attributes']['test_ref_adequation_profil_id'] : "null",
                                    'pourcentage_score' => isset($adequate['pourcentage_score']) ? $adequate['pourcentage_score'] : "null",
                                    'score' => isset($adequate['score']) ? $adequate['score'] : null,
                                    'color' => isset($adequate['couleur_classe']) ? $adequate['couleur_classe'] : null,
                                    'adequation_profile' => isset($rapport_class) ? $rapport_class : [],
                                ];
                                unset($test_ref_adequation);
                                unset($rapport_class);
                            }
                        }
                        $class_id = isset($value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes']['test_ref_adequation_classe_id']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes']['test_ref_adequation_classe_id'] : 0;
                        foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {
                            $id = isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['test_ref_adequation_profil_id'] : 0;
                            if ($id == $test_ref["@attributes"]["id"]) {

                                $test_ref_adequation =
                                    [
                                        'id' => $test_ref["@attributes"]["id"],
                                        'label' => $test_ref["contenus"]["contenu"]["libelle"],
                                        'description' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description"]) ? $test_ref["contenus"]["contenu"]["description"] : null),
                                        'description_long' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null),

                                    ];
                            }
                        }
                        // test_classes
                        foreach ($xml['elements']['test_ref_adequation_classes']['test_ref_adequation_classe'] as $class) {
                            if ($class['@attributes']['id'] == $class_id) {
                                $rapport_class[] = [
                                    "label" => $class['contenus']['contenu']['libelle'],
                                    "description" => $class['contenus']['contenu']['description'],
                                    "description_long" => $class['contenus']['contenu']['description_longue'],
                                    'test_ref_adequation' => isset($test_ref_adequation) ? $test_ref_adequation : [],
                                ];
                            }
                        }

                        $adequates   = [
                            'id' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['id']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['id'] : null,
                            'pourcentage_score' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score'] : null,
                            'score' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['score']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['score'] : null,
                            'color' => isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['couleur_classe']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['couleur_classe'] : null,
                            'adequation_profile' => isset($rapport_class) ? $rapport_class : [],
                        ];
                        unset($test_ref_adequation);
                        unset($rapport_class);
                    } else {
                        // print_r(" classess object {} profile array");


                        $class_id = isset($value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes']['test_ref_adequation_classe_id']) ? $value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes']['test_ref_adequation_classe_id'] : 0;

                        foreach ($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils'] as $adequate_profiles) {

                            foreach ($adequate_profiles as $key => $adequate_profile) {
                                $id = isset($adequate_profile['@attributes']['test_ref_adequation_profil_id']) ? $adequate_profile['@attributes']['test_ref_adequation_profil_id'] : 0;
                                foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {

                                    if ($id == $test_ref["@attributes"]["id"]) {
                                        $test_ref_adequation =
                                            [
                                                'id' => $test_ref["@attributes"]["id"],
                                                'label' => $test_ref["contenus"]["contenu"]["libelle"],
                                                'description' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description"]) ? $test_ref["contenus"]["contenu"]["description"] : null),
                                                'description_long' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null),

                                            ];
                                    }
                                }

                                // test_classes
                                foreach ($xml['elements']['test_ref_adequation_classes']['test_ref_adequation_classe'] as $class) {
                                    if ($class['@attributes']['id'] == $class_id) {
                                        $rapport_class[] = [
                                            "label" => $class['contenus']['contenu']['libelle'],
                                            "description" => $class['contenus']['contenu']['description'],
                                            "description_long" => $class['contenus']['contenu']['description_longue'],
                                            'test_ref_adequation' => isset($test_ref_adequation) ? $test_ref_adequation : [],
                                        ];
                                    }
                                }


                                $adequates[] = [
                                    'id' => isset($adequate_profile['@attributes']) ? $adequate_profile['@attributes']['test_ref_adequation_profil_id'] : "null",
                                    'pourcentage_score' => isset($adequate_profile['pourcentage_score']) ? $adequate_profile['pourcentage_score'] : "null",
                                    'score' => isset($adequate_profile['score']) ? $adequate_profile['score'] : null,
                                    'color' => isset($adequate_profile['couleur_classe']) ? $adequate_profile['couleur_classe'] : null,
                                    'adequation_profile' => isset($rapport_class) ? $rapport_class : [],
                                ];
                                unset($test_ref_adequation);
                                unset($rapport_class);
                            }
                        }
                    }
                } else {
                    // print_r("class array");
                    foreach ($value['rapport_adequation_classes'] as $adequation_classes) {

                        if (isset($adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['@attributes'])) {
                            // print_r("profile object");
                            $adequates   = [
                                'id' => isset($adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['id']) ? $adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['@attributes']['id'] : null,
                                'pourcentage_score' => isset($adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score']) ? $adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score'] : null,
                                'score' => isset($adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['score']) ? $adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['score'] : null,
                                'color' => isset($adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['couleur_classe']) ? $adequation_classes['rapport_adequation_profils']['rapport_adequation_profil']['couleur_classe'] : null,
                                'adequation_profile' => isset($test_ref_adequation) ? $test_ref_adequation : [],
                            ];
                            unset($test_ref_adequation);
                        } else {
                            // print_r("profile array");

                            foreach ($adequation_classes as $adequate_classe) {
                                $class_id = isset($adequate_classe['@attributes']['test_ref_adequation_classe_id']) ? $adequate_classe['@attributes']['test_ref_adequation_classe_id'] : 0;
                                foreach ($adequate_classe['rapport_adequation_profils']['rapport_adequation_profil'] as $adequate_profiles) {
                                    //test_profiles
                                    foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {
                                        $id = isset($adequate_profiles['@attributes']['test_ref_adequation_profil_id']) ? $adequate_profiles['@attributes']['test_ref_adequation_profil_id'] : 0;
                                        if ($id == $test_ref["@attributes"]["id"]) {
                                            //profiles
                                            // dd($test_ref);
                                            $test_ref_adequation[] =
                                                [
                                                    'id' => $test_ref["@attributes"]["id"],
                                                    'label' => $test_ref["contenus"]["contenu"]["libelle"],
                                                    'description' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["libelle"]) ? $test_ref["contenus"]["contenu"]["libelle"] : null),
                                                    'description_long' => $this->getMNText(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null),
                                                    'pourcentage_score' => isset($adequate_profiles['pourcentage_score']) ? $adequate_profiles['pourcentage_score'] : null,
                                                    'score' => isset($adequate_profiles['score']) ? $adequate_profiles['score'] : null,
                                                    'color' => isset($adequate_profiles['couleur_classe']) ? $adequate_profiles['couleur_classe'] : null,
                                                ];
                                        }
                                    }
                                }
                                // test_classes
                                foreach ($xml['elements']['test_ref_adequation_classes']['test_ref_adequation_classe'] as $class) {
                                    if ($class['@attributes']['id'] == $class_id) {
                                        $rapport_class = [
                                            "id" => $class['@attributes']['id'],
                                            "label" => $class['contenus']['contenu']['libelle'],
                                            "description" => $class['contenus']['contenu']['description'],
                                            "description_long" => $class['contenus']['contenu']['description_longue'],
                                            'test_ref_adequation' => isset($test_ref_adequation) ? $test_ref_adequation : [],
                                        ];
                                    }
                                }

                                $adequates[] = [
                                    'adequation_profile' => isset($rapport_class) ? $rapport_class : null

                                ];


                                // dd($adequates);
                                unset($test_ref_adequation);
                                unset($rapport_class);
                            }
                        }
                    }
                }
            }
            $party["party"][] =
                [
                    'id' => $value["@attributes"]["id"],
                    'test_group_factor_id' => isset($value['@attributes']['id']) ? $value['@attributes']['id'] : null,
                    'type' =>  $value["@attributes"]["type"],
                    'params' =>  $value['params'],
                    'content' => array(
                        'label' => $this->getMNText($value["contenus"]["contenu"]["libelle"]),
                        'title' => $this->getMNText(isset($value["contenus"]["contenu"]["titre"]) ? $value["contenus"]["contenu"]["titre"] : null),
                        'title_1' => $this->getMNText(isset($value["contenus"]["contenu"]["title"]) ? $value["contenus"]["contenu"]["title"] : null),
                        'targets' => isset($value["contenus"]["contenu"]["targets"]) ? $value["contenus"]["contenu"]["targets"] : null,
                        'sub_title' => $this->getMNText(isset($value["contenus"]["contenu"]["sous_titre"]) ? $value["contenus"]["contenu"]["sous_titre"] : null),
                        'description_long' => $this->getMNText(isset($value["contenus"]["contenu"]["description_longue"]) ? $value["contenus"]["contenu"]["description_longue"] : null),
                        'description' => $this->getMNText(isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null),
                        'description_1' => $this->getMNText(isset($value["contenus"]["contenu"]["description_1"]) ? $value["contenus"]["contenu"]["description_1"] : null),
                        'description_2' => $this->getMNText(isset($value["contenus"]["contenu"]["description_2"]) ? $value["contenus"]["contenu"]["description_2"] : null),
                        'introduction' => $this->getMNText(isset($value["contenus"]["contenu"]["introduction"]) ? $value["contenus"]["contenu"]["introduction"] : null),
                        'description_courte' => $this->getMNText(isset($value["contenus"]["contenu"]["description_courte"]) ? $value["contenus"]["contenu"]["description_courte"] : null),
                        'description_courte_opposition' => $this->getMNText(isset($value["contenus"]["contenu"]["description_courte_opposition"]) ? $value["contenus"]["contenu"]["description_courte_opposition"] : null),
                        'libelle_facteur' => $this->getMNText(isset($value["contenus"]["contenu"]["libelle_facteur"]) ? $value["contenus"]["contenu"]["libelle_facteur"] : null),
                        'libelle_facteur_opposition' => $this->getMNText(isset($value["contenus"]["contenu"]["libelle_facteur_opposition"]) ? $value["contenus"]["contenu"]["libelle_facteur_opposition"] : null),
                        'domain'  => isset($domain) ? $domain : [],
                        'label_group'  => array_key_exists(
                            'libelle_groupe_opposition',
                            $value["contenus"]["contenu"]
                        ),
                        'commentaire_perso' => $this->getMNText(isset($value["contenus"]["contenu"]["commentaire_perso"]) ? $value["contenus"]["contenu"]["commentaire_perso"] : null),
                    ),
                    'adequacy' => $adequates,
                ];

            unset($domain);
            //setting all values to variable $data
            $data["parties"] = $this->replaceChar($candidate_name, $party);
        }
        // dd($data);
        return view('layouts.reports.' . $data['general']['test_id'], compact('data'));
    }

    public function replaceName($candidate_name, $content)
    {
        // dd($candidate_name);
        // dd($content);
        $replaced = str_replace($candidate_name, "$", $content);
        return $replaced;
    }

    public function getMNText($str)
    {
        // print_r($str);
        $text = Translation::select('MN')->where('EN', '=', $str)->value("MN");
        if (!$text) {   
            // print_r($str);   
            return $str;
        }

        return $text;
    }

    public function replaceChar($candidate_name, $content)
    {
        $replaced = str_replace("$", $candidate_name, $content);
        return $replaced;
    }


    // getdata
    public function getData($assessment_id)
    {
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
            'passed_date' => $xml['params']['date_passation_fin']
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
                        foreach ($domains["cibles_secondaires"]["cibles_secondaire"] as $secondary_target) {
                            // dd($domains["cibles_secondaires"]["cibles_secondaire"]);
                            $comments[]  = [
                                'color' => isset($secondary_target["color"]) ? $secondary_target["color"] : null,
                                "score" =>  isset($secondary_target["score"]) ? $secondary_target["score"] : 0,
                                "comment" =>  $this->getMNText(isset($secondary_target["contenus"]["contenu"]["commentaire_perso"]) ? $secondary_target["contenus"]["contenu"]["commentaire_perso"] : null),
                            ];
                        }
                    }
                    if (isset($domains["@attributes"])) {
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
            if (
                isset($value['rapport_adequation_classes'])
                && isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil'])
            ) {
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
                        'domain'  => isset($domain) ? $domain : [],
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
