<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Support\Collection;
use App\TestAPI;
use Illuminate\Support\Facades\Http;

class CandidateController extends Controller
{
    private function header($url, $format){
        $result = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get($url.'/'.$format);

        return $result;
    }

    // get list title
    function getGroup(){

        $results = $this->header('https://app.centraltest.com/customer/REST/list/title', 'json');

        // return $results;
        $data = json_decode($results);

        return view('layouts.candidate.group', compact('data'));
    }

    // get Group
    public function group(){
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->post('https://app.centraltest.com/customer/REST/list/group/json');

        $data = json_decode($response);

        return view('layouts.candidate.group', compact('data'));
    }

    function getCompany(){

        $result = $this->header('https://app.centraltest.com/customer/REST/list/test', 'json');

        return $result;
    }

    // get canditates
    function index(Request $request){
        // return $results;
        $group = $this->header('https://app.centraltest.com/customer/REST/list/group', 'json');
        $groups = json_decode($group);

        if($request->group_id){
            $results = Http::withHeaders([
                'WWW-Authenticate'=> $this->token
            ])->get('https://app.centraltest.com/customer/REST/retrieve/group/json',
            [
                'id' => $request->group_id
            ]);

            $group_id = $request->group_id;
        }else
            $group_id = null;

        $canditateList = array();

        if(isset($results) && $results['candidates']){
            foreach($results['candidates'] as $candidate){
                $candidates = Http::withHeaders(['WWW-Authenticate'=> $this->token])->get('https://app.centraltest.com/customer/REST/retrieve/candidate/json',
                    [
                        'id' =>  $candidate['id']
                    ]);
                $canditateList[] = json_decode($candidates);
            }
        }elseif(isset($request->email)){
            $candidates = Http::withHeaders(['WWW-Authenticate'=> $this->token])->get('https://app.centraltest.com/customer/REST/retrieve/candidate/json',
                [
                    'email' =>  $request->email
                ]);
            $canditateList[] = json_decode($candidates);
        }

        return view('layouts.candidate.list', compact('canditateList', 'groups', 'group_id'));
    }

     public function contract()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->post('https://app.centraltest.com/customer/REST/list/contract/json');

        return $response;
    }


    public function getToken(){
        return $this->token;
    }

    public function assessments($candidate_id = null)
    {
        // https://app.centraltest.com/customer/REST/assessment/paginate/completed/
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->GET('https://app.centraltest.com/customer/REST/assessment/completed/json',
        [
            'candidate_id' => $candidate_id
        ]);

        $assessments = json_decode($response);
        // тухайн хэрэглэгчийн утга буцсан байвал тухайн id-г аваад
        foreach ($assessments as $item) {
            $test = TestAPI::find($item->test_id);
            $item->test = $test->label;
        }
        // тухайн тестийн утгуудыг авна
        // mестийн үр дүнг буцааж авна.
        return view('layouts.candidate.assessments', compact('assessments'));
    }

    public function getTest()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/assessment/test_factors/json',
        [
            'test_id' => 13
        ]);

        return $response;
    }

    // get Test info
    public function testList(){
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/list/test/json',
        [
        ]);
        return $response;
    }



}
