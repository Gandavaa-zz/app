<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestApiController extends Controller
{
    private function header($url, $format)
    {
        $result = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get($url . '/' . $format);

        return $result;
    }

    public function index(Request $request)
    {
        $primary_tests = array('Occupational Interest Inventory-R', 'Big Five Profile', 'CTPI-R', 'EMOTION', 'Sales Profile–R', 'Professional Profile 2', 'Reasoning Test-R', 'Entrepreneur Test', 'VOCATION');
        // get all result from API TEST
        $responses = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get('https://app.centraltest.com/customer/REST/list/test/json',
            []);

       //  insert to Test result to TEST
        foreach (json_decode($responses) as $response) {
            $priority = 0;

            if (in_array($response->label, $primary_tests)){
                $priority = 1;
            }
            $test = Test::firstOrCreate(
                ['id' => $response->id],
                ['id' => $response->id,
                    'category' => $response->category,
                    'label' => $response->label,
                    'logo' => $response->logo,
                    'price_in_credits' => $response->price_in_credits,
                    'priority' => $priority
                ]);
        }

        $tests = Test::paginate(10);

        return view('layouts.test.list', compact('tests'));
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
