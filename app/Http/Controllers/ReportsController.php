<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReportsController extends Controller
{
    public function result($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get('https://app.centraltest.com/customer/REST/assessment/result/xml',
            [
                'id' => $assessment_id,
            ]);

        return $response;
    }

    function global ($assessment_id = null) {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->post('https://app.centraltest.com/customer/REST/report/score/json',
            [
                'id' => $assessment_id,
            ]);
        return $response;
    }

    public function factory($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get('https://app.centraltest.com/customer/REST/report/factors_scores/json',
            [
                'assessment_id' => $assessment_id,
            ]);

        return $response;
    }

    public function groups($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->post('https://app.centraltest.com/customer/REST/report/groups_score/json',
            [
                'assessment_id' => $assessment_id,
            ]);

        return $response;
    }

    public function referential($assessment_id = null)
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token,
        ])->get('https://app.centraltest.com/customer/REST/assessment/referentials/json',
            [
                'id' => $assessment_id,
            ]);

        return $response;
    }

    public function getHtml($assessment_id = null)
    {
        //    return $assessment_id;
        $link = request()->input('link');
        $response = Http::get($link);
        return $response;
    }

    public function getXml($assessment_id = null)
    {
        // print_r($encrypted);
        if (Storage::exists("/assets/assessments/{$assessment_id}.xml")) {
            $contents = Storage::get("assets/assessments/{$assessment_id}.xml");
            // $decrypted= Crypt::decryptString($contents);
            $xml = xml_decode($contents);
            return $xml;

        } else {
            $response = Http::withHeaders([
                'WWW-Authenticate' => $this->token,
            ])->get('https://app.centraltest.com/customer/REST/assessment/result/xml',
                [
                    'id' => $assessment_id,
                    'language_id' => "1",
                ]);
            // $encrypted = Crypt::encryptString($response);
            Storage::put("/assets/assessments/{$assessment_id}.xml", $response);
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
