<?php

namespace App\Http\Controllers;

use App\TestAPI;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class TestApiController extends Controller
{
    private function header($url, $format){
        $result = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get($url.'/'.$format);

        return $result;
    }

    public function index(Request $request) {

        $count = TestAPI::count();
        // get all result from API TEST
        $responses = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->get('https://app.centraltest.com/customer/REST/list/test/json',
        []);

        //  insert to Test result to TESTAPI
        foreach(json_decode($responses) as $response){
            $testAPI = TestAPI::firstOrCreate(
                ['id' => $response->id],
                [ 'id'    => $response->id,
                  'category' => $response->category,
                  'label' => $response->label,
                  'logo' => $response->logo,
                  'price_in_credits' => $response->price_in_credits
            ]);
        }

        // return testAPI result
        $tests = TestAPI::paginate(10);

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
