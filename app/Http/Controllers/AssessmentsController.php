<?php

namespace App\Http\Controllers;

use App\Candidate;
use App\TestAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AssessmentsController extends Controller
{
    /**
     * Display a listing of the Assessments from API.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tests = TestAPI::all();
        // Хэрвээ test_id шүүх болон candidate_id-р шүүнэ.
        if ($request->test_id){
            $response = Http::withHeaders([
                'WWW-Authenticate'=> $this->token
            ])->post('https://app.centraltest.com/customer/REST/assessment/paginate/completed/json',  [
                'test_id' => $request->test_id
            ]);
        }
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->post('https://app.centraltest.com/customer/REST/assessment/paginate/completed/json');
        // return $assessments;
        // echo json_decode($assessments);
        $assessments = json_decode($response, true);
        // тухайн assessment-тад data нэмэх
        // return $assessments['result']['data'];
        foreach( $assessments['result']['data'] as $key => $value){
            // return $value['test_id'];
            $candidate = Candidate::find($value['candidate_id']);
            $assessments['result']['data'][$key]['candidate'] = $candidate;

            $test = TestAPI::find($value['test_id']);
            $assessments['result']['data'][$key]['test'] = $test;
        }

        // return $assessments;
        // $candidate= retrieve https://app.centraltest.com/customer/REST/retrieve/candidate/ [FORMAT ]
        // foreach хийж тухайн id-р хэрэглэгчтэй тестийг холбоно
        // test_id -mай холбох
        // candidate_id тай холбох
        return view('layouts.assessments.index', compact('assessments', 'tests'));
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
