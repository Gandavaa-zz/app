<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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

        return $response;

        // $xmlObject = simplexml_load_string($xmlString);
        // $json = json_encode($xmlObject);
        // $phpArray = json_decode($json, true);
        // dd($phpArray);
        // foreach ($phpArray['elements'] as $key => $value) {
        //     dd($key);
        // }

        // $json  = json_encode($xml);
        // $array_data = json_decode($json, true);

        // return $array_data;
        // return str_replace('<html>', ' ', $response);
        // $xhtml = <? xml version='1.0' encoding='UTF-8'
        // return simplexml_load_string($response);
        // ($response, 200)->header('Content-Type', 'application/xml')
    }

    function global($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate'=> $this->token
        ])->post('https://app.centraltest.com/customer/REST/report/score/json',
        [
            'id' => $assessment_id
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
        ])->post('https://app.centraltest.com/customer/REST/report/groups_score/json',
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

    function getHtml($assessment_id = null)
    {
    //    return $assessment_id;
        $link = request()->input('link');
        $response = Http::get($link);
        return $response;
    }

    function getXml($assessment_id = null)
    {
        // print_r($encrypted);
        if($contents = Storage::get("assets/assessments/{$assessment_id}.xml")){
            $decrypted= Crypt::decryptString($contents);
            $xml = xml_decode($decrypted);
            return $xml;
        }else {
            $response = Http::withHeaders([
                'WWW-Authenticate'=> $this->token
            ])->get('https://app.centraltest.com/customer/REST/assessment/result/xml',
            [
                'id' => $assessment_id,
                'language_id' => "1"
            ]);

            $encrypted = Crypt::encryptString($response);
            Storage::put("/assets/assessments/{$assessment_id}.xml", $encrypted);
            return true;
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