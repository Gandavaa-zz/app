<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Group;
use App\Test;
use App\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DateTime;
use \PDF;

class AssessmentsController extends Controller
{
    /**
     * Display a listing of the Assessments from API.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return $request->test_id;
        $groups = Group::all();

        $tests = Test::where('priority', 1)->get();
        // Хэрвээ test_id шүүх болон candidate_id-р шүүнэ.
        $current_page_count = ($request->current_page_count) ? $request->current_page_count : 10;
        if ($request->page) $page = $request->page;
        else $page = 1;

        $filter = array(
            'order_asc' => 0,
            'page' => $page,
            'per_page' => $current_page_count
        );
        if ($request->test_id != 0) $filter['test_id'] = $request->test_id;
        if ($request->group_id != 0) $filter['group_id'] = $request->group_id;
        if ($request->from_date != 0) $filter['due_date_from'] = $request->from_date . ' 00:00:00';
        if ($request->to_date != 0) $filter['due_date_to'] = $request->to_date . ' 00:00:00';

        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get('https://app.centraltest.com/customer/REST/assessment/paginate/completed/json',  $filter);
        $assessments = json_decode($response, true);

        // тухайн assessment-тад data нэмэх
        foreach ($assessments['result']['data'] as $key => $value) {
            // return $value['test_id'];
            $candidate = Candidate::find($value['candidate_id']);

            if ($candidate && isset($candidate)) {
                $assessments['result']['data'][$key]['candidate'] = $candidate;
            } else {
                // get candidate from API
                $candidateJson = Http::withHeaders([
                    'WWW-Authenticate' => $this->token,
                ])->get(
                    'https://app.centraltest.com/customer/REST/retrieve/candidate/json',
                    [
                        'id' => $value['candidate_id']
                    ]
                );
                $newCandidate = json_decode($candidateJson, true);

                $candidate = Candidate::create([
                    'id' => $newCandidate['id'],
                    'title_id' => $newCandidate['title_id'],
                    'country_code' => $newCandidate['country_code'],
                    'email' => $newCandidate['email'],
                    'lastname' => $newCandidate['lastname'],
                    'firstname' => $newCandidate['firstname'],
                    'last_connection_date' => $newCandidate['last_connection_date']
                ]);

                foreach ($newCandidate['groups'] as $group) {
                    $candidate->groups()->attach($group['id']);
                }
                $assessments['result']['data'][$key]['candidate'] = $newCandidate;
            }

            $test = Test::find($value['test_id']);
            $assessments['result']['data'][$key]['test'] = $test;
        }

        $pagination = $assessments['result']['pagination'];
        // return $assessments;
        return view('layouts.assessments.index', compact('assessments', 'tests', 'groups', 'pagination'));
    }



    // print assessment as pdf
    public function generatePDF()
    {
        $data = [];
        $view = PDF::loadView('layouts.reports.components.generatePDF');
        // $view = View('layouts.components.generatePDF', []);
        return $view->download('hello.pdf');
    }


    /**
     * Sales Profile fix
     */
    public function salesProfile($assessment_id = null)
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
            Storage::put("/assets/assessments/{$assessment_id}.xml", $response);
        }

        /*  1. Parties-с шүүж харуулна
            2. fdsfds
        */
        $contents = Storage::get("assets/assessments/$assessment_id.xml");

        $xml = xml_decode($contents);

        // return $xml;

        $salesProfile = array();

        foreach ($xml['parties']['partie'] as $part) {
            $salesProfile[] = $part['params']['ordre'];

            // if ordre 1 content -s title avna
            switch ($part['params']['ordre']) {
                case 1:
                    $salesProfile[1] = array();
                    $salesProfile[1]['title'] =  $part['contenus']['contenu']['titre'];
                    $salesProfile[1]['subtitle'] = $part['contenus']['contenu']['sous_titre'];
                    break;
                case 2:
                    $salesProfile[2] = array();
                    $salesProfile[2]['score'] =  $part['params']['moyenne_generale'];
                    $salesProfile[2]['percentage'] =  $part['params']['pourcentage_score'];
                    $salesProfile[2]['color'] =  $part['params']['note_couleur'];
                    $salesProfile[2]['title'] =  $part['contenus']['contenu']['titre'];
                    $salesProfile[2]['description'] = $part['contenus']['contenu']['description_courte'];
                    break;
                case 3:
                    $salesProfile[3] = array();
                    $salesProfile[3]['title'] =  $part['contenus']['contenu']['titre'];
                    $salesProfile[3]['introduction'] = $part['contenus']['contenu']['introduction'];
                    $salesProfile[3]['percentage_score'] = $part['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['pourcentage_score'];
                    break;

                case 4:
                    $salesProfile[4] = array();
                    $salesProfile[4]['type'] = 'text';
                    $salesProfile[4]['title'] =  $part['contenus']['contenu']['titre'];
                    break;

                case 5:
                    $salesProfile[5] = array();
                    if ($part['@attributes']['type'] == 'rapport_graphique') {
                        $salesProfile[5]['type'] = 'graphic';
                        $salesProfile[5]['label'] =  $part['contenus']['contenu']['libelle'];
                        $salesProfile[5]['title'] =  $part['contenus']['contenu']['titre'];
                    }
                    break;

                case 6:
                    $salesProfile[6] = array();
                    if ($part['@attributes']['type'] == 'rapport_ancre') {
                        $salesProfile[6]['title'] =  $part['contenus']['contenu']['titre'];
                        $salesProfile[6]['sub_title'] =  $part['contenus']['contenu']['sous_titre'];
                    }
                    break;
            }
        }

        return $salesProfile;
    }

    /**
     *  Reports of assessments 
     * @param  int  $assessment_id
     * @return string $xml of results
     */

    public function report($assessment_id)
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
        // dd($data["test_factors"]);
        $test_factors = array_unique($data["test_factors"], SORT_REGULAR);
        $data["test_factors"] = $test_factors;
        // dd($data["test_factors"]);
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
                                "title" => $this->getMNText($label),
                                "comment" =>  $this->getMNText(isset($item["contenus"]["contenu"]["commentaire_perso"]) ? $item["contenus"]["contenu"]["commentaire_perso"] : null),
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
                                if (isset($item['cibles_secondaires']['cibles_secondaire']))
                                    foreach ($data['test_factors'] as $test_factor) {
                                        if ($item['cibles_secondaires']['cibles_secondaire']['@attributes']["target_id"] == $test_factor['id'])
                                            $label = $test_factor['label'];
                                    }

                                $comments[] = [
                                    'color' => isset($item["cibles_secondaires"]["cibles_secondaire"]['color']) ? $item["cibles_secondaires"]["cibles_secondaire"]['color'] : null,
                                    "score" =>  isset($item["cibles_secondaires"]["cibles_secondaire"]["score"]) ? $item["cibles_secondaires"]["cibles_secondaire"]["score"] : 0,
                                    "title" =>  $label,
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
                                                // if (str_contains($test_factor['label'], "Creative"))
                                                // print_r($test_factor);
                                            }
                                        }

                                        $comments[]  = [
                                            'color' => isset($row["color"]) ? $row["color"] : null,
                                            "score" =>  isset($row["score"]) ? $row["score"] : 0,
                                            "title" => $this->getMNText($label),
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
                            // dd($value['rapport_adequation_classes']['rapport_adequation_classe']);
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
                        'cibles' => isset($value["contenus"]["contenu"]["cibles"]) ? $value["contenus"]["contenu"]["cibles"] : null,
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
            $data["parties"] = $this->replaceChar($this->getMNText($candidate_name), $party);
        }
        // dd($data);
        return view('layouts.reports.' . $data['general']['test_id'], compact('data'));
    }


    /*
    * @param  string  $str
    * @return string $str
    */
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

        // if (strpos($str, "Ariuntuyaa Erdenebaatar")) {

        //     dd($str);
        // }

        $text = Translation::select('MN')->where('EN', '=', $str)->value("MN");
        if (!$text) {
            return $str;
        }

        return $text;
    }

    public function replaceChar($candidate_name, $content)
    {
        $replaced = str_replace("$", $candidate_name, json_encode($content));

        return json_decode($replaced, true);
    }
}
