<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScoresController extends Controller
{
    function result($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/assessment/result/xml',
        [
            'id' => $assessment_id
        ]);

        // echo $response;
        // ($response, 200)->header('Content-Type', 'application/xml')
        return $response;

    }

    function global($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->post('https://app.centraltest.com/customer/REST/report/score/json',
        [
            'assessment_id' => $assessment_id
        ]);

        return $response;
    }

    function factory($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/report/factors_scores/json',
        [
            'assessment_id' => $assessment_id
        ]);

        return $response;
    }

    function groups($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/report/groups_score/json',
        [
            'assessment_id' => $assessment_id
        ]);

        return $response;
    }

    function referential($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/assessment/referentials/json',
        [
            'id' => $assessment_id
        ]);

        return $response;
    }

}
