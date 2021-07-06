<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\Group;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
        $from_date =  ($request->from_date) ? $request->from_date . ' 00:00:00' : null;
        $to_date =  ($request->to_date) ? $request->to_date . ' 00:00:00' : null;
        $current_page_count = ($request->current_page_count) ? $request->current_page_count : 10;
        if ($request->page) $page = $request->page;
        else $page = 1;

        $group_id = ($request->group_id) ? $request->group_id : null;

        // request-д утга байгаа бол доорх url-с шүүлт хийнэ.
        if ($request->test_id) {
            $response = Http::withHeaders([
                'WWW-Authenticate' => $this->token
            ])->get('https://app.centraltest.com/customer/REST/assessment/paginate/completed/json',  [
                'order_asc' => 0,
                'test_id' => $request->test_id,
                'group_id' => $request->group_id,
                'due_date_from' => $from_date,
                'due_date_to' => $to_date,
                'per_page' => $current_page_count,
                'page' => $page
            ]);
        } else {
            $response = Http::withHeaders([
                'WWW-Authenticate' => $this->token
            ])->get('https://app.centraltest.com/customer/REST/assessment/paginate/completed/json', [
                'order_asc' => 0,
                'per_page' => $current_page_count,
                'page' => $page
            ]);
        }

        $assessments = json_decode($response, true);

        // тухайн assessment-тад data нэмэх
        foreach ($assessments['result']['data'] as $key => $value) {
            // return $value['test_id'];
            $candidate = Candidate::find($value['candidate_id']);
            $assessments['result']['data'][$key]['candidate'] = $candidate;

            $test = Test::find($value['test_id']);
            $assessments['result']['data'][$key]['test'] = $test;
        }

        // return $assessments;
        $pagination = $assessments['result']['pagination'];

        // return $pagination;
        // $candidate= retrieve https://app.centraltest.com/customer/REST/retrieve/candidate/ [FORMAT ]
        // foreach хийж тухайн id-р хэрэглэгчтэй тестийг холбоно
        // test_id -mай холбох
        // candidate_id тай холбох
        return view('layouts.assessments.index', compact('assessments', 'tests', 'groups', 'pagination'));
    }

    public function test()
    {
        echo "test";
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

        return $xml;

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
