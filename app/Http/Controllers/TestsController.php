<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestsController extends Controller
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

}
