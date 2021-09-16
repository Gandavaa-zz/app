<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Translation;

class ImportsController extends Controller
{
    private $candidate_name = null;
    private $test_id = null;

    /**
     * Display an imports settings.
     *
     * @return \view
     */
    public function index()
    {
        $tests = Test::where('priority', 1)->get();

        return view('layouts.import.index', compact('tests'));
    }

    /**
     * Store a newly created resource in test_translation.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        // test_id-р тухайн assessment-г дуудаж харуулах
        // assessment-дээр байгаа утгуудаас тестийг оруулах
        $filter['test_id'] = $request->test_id;

        $this->test_id = $request->test_id;

        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get('https://app.centraltest.com/customer/REST/assessment/paginate/completed/json',  $filter);

        // if assessment_id in imported test then get next index of id        
        $id = rand(0, 50);
        $assessment_id = $response['result']['data'][$id]['id'];

        if (!Storage::exists("/assets/assessments/{$assessment_id}.xml")) {
            $response = Http::withHeaders([
                'WWW-Authenticate' => $this->token,
            ])->get(
                'https://app.centraltest.com/customer/REST/assessment/result/xml',
                [
                    'id' => $assessment_id,
                    'language_id' => "1"
                ]
            );
            // $encrypted = Crypt::encryptString($response);
            Storage::put("/assets/assessments/{$assessment_id}.xml", $response);
        }

        // test-n xml avchlaa
        $contents = Storage::get("assets/assessments/{$assessment_id}.xml");
        $xml = xml_decode($contents);
        // return $xml;
        $this->candidate_name = $xml["noyau_utilisateur_info"]["prenom"] . " " . $xml["noyau_utilisateur_info"]["nom"];
        
        foreach ($xml['elements']['test_groupe_facteurs']['test_groupe_facteur'] as $value) {            
            foreach ($xml['elements']['test_facteurs']['test_facteur'] as $factors) {
                // insert this content 
                $this->save($insert = $factors["contenus"]["contenu"]["libelle"]);

                if ($factors["@attributes"]["test_groupe_facteur_id"] == $value["@attributes"]["id"]) {
                    foreach ($xml['parties']['partie'] as $row) {
                        if ($row['@attributes']['type'] == 'rapport_details_facteur' && ($row['contenus']['contenu']['titre'] == $factors["contenus"]["contenu"]["libelle"] || $row['contenus']['contenu']['libelle_facteur'] == $factors["contenus"]["contenu"]["libelle"])) {
                            $this->save($row['contenus']['contenu']['description_courte']);
                            $this->save($row['contenus']['contenu']['description_courte_opposition']);
                            $this->save($factors["contenus"]["contenu"]["libelle"]);
                        }
                    }
                    // dd($description);      
                }
            }
        }

        foreach ($xml['parties']['partie'] as $value) {

            if (isset($value["domaines"]["domaine"])) {
                if (isset($value["domaines"]["domaine"]['@attributes'])) {                                 
                    if (isset($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire']['@attributes'])) {
                            $this->save(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"] : null);
                            $this->save(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"] : null);
                            isset($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) ? $this->save($value["domaines"]["domaine"]["contenus"]["contenu"]["libelle"]) : null;                    
                    } else {
                        foreach ($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire'] as $item) {                           
                            $this->save(isset($item["contenus"]["contenu"]["commentaire_perso"]) ? $item["contenus"]["contenu"]["commentaire_perso"] : null);                            
                                isset($item["contenus"]["contenu"]["libelle"]) ? $this->save($item["contenus"]["contenu"]["libelle"]) : null;                                
                        }
                    }
                } else {
                    if (isset($value["domaines"]["domaine"]['cibles_secondaires']['cibles_secondaire']['@attributes'])) {                        
                        $this->save(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"]) ?
                            $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["libelle"] : null);
                        $this->save(isset($value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"]) ?
                                $value["domaines"]["domaine"]["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"] : null);
                    }else{
                        foreach ($value["domaines"]["domaine"] as $item) {
                            if (isset($item['cibles_secondaires']['cibles_secondaire']['@attributes'])) {
                                $this->save( isset($item["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"]) ?
                                        $item["cibles_secondaires"]["cibles_secondaire"]["contenus"]["contenu"]["commentaire_perso"] : null);
                                $this->save( isset($item["contenus"]["contenu"]["libelle"]) ? $item["contenus"]["contenu"]["libelle"] : null );                                      
                            } else {                                
                                foreach ($item['cibles_secondaires']['cibles_secondaire'] as $row) {                                   
                                    $this->save(isset($row["contenus"]["contenu"]["commentaire_perso"]) ? $row["contenus"]["contenu"]["commentaire_perso"] : null);                                    
                                }
                            }                           
                        }
                    }
                }
            }
            if (isset($value['rapport_adequation_classes'])) {
                if (isset($value['rapport_adequation_classes']['rapport_adequation_classe']['@attributes'])) {
                    if (isset($value['rapport_adequation_classes']['rapport_adequation_classe']                    
                    ['rapport_adequation_profils']['rapport_adequation_profil']['@attributes'])) {                       
                        // print_r("rapport_adequation_classes >  profile object");
                        if (isset($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes'])) {
                            $value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil']['@attributes'];                            
                        } else {                            
                            foreach ($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils']['rapport_adequation_profil'] as $adequate) {
                                foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {
                                    $this->save(isset($test_ref["contenus"]["contenu"]["description"]) ? $test_ref["contenus"]["contenu"]["description"] : null);
                                    $this->save(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null);
                                }                                
                            }
                        }                        
                        foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {                                                        
                            $this->save(isset($test_ref["contenus"]["contenu"]["description"]) ? $test_ref["contenus"]["contenu"]["description"] : null);
                            $this->save(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null);                
                        }
                    } else {

                        foreach ($value['rapport_adequation_classes']['rapport_adequation_classe']['rapport_adequation_profils'] as $adequate_profiles) {
                            foreach ($adequate_profiles as $key => $adequate_profile) {
                                foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {
                                    $this->save(isset($test_ref["contenus"]["contenu"]["description"]) ? $test_ref["contenus"]["contenu"]["description"] : null);
                                    $this->save(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"]:null);
                                }                                                                
                                
                            }
                        }
                    }
                } else {
                    // print_r("class array");
                    foreach ($value['rapport_adequation_classes'] as $adequation_classes) {
                        // print_r("profile array");
                        foreach ($adequation_classes as $adequate_classe) {
                            
                            foreach ($adequate_classe['rapport_adequation_profils']['rapport_adequation_profil'] as $adequate_profiles) {
                                //test_profiles
                                foreach ($xml['elements']['test_ref_adequation_profils']['test_ref_adequation_profil'] as $test_ref) {
                                    if ($id == $test_ref["@attributes"]["id"]) {
                                        $this->save(isset($test_ref["contenus"]["contenu"]["libelle"]) ? $test_ref["contenus"]["contenu"]["libelle"] : null);
                                         $this->save(isset($test_ref["contenus"]["contenu"]["description_longue"]) ? $test_ref["contenus"]["contenu"]["description_longue"] : null);

                                    }
                                }
                            }
                        }                        
                    }
                }
            }
            
            $this->save(isset($value["contenus"]["contenu"]["libelle"]) ? $value["contenus"]["contenu"]["libelle"] : null );
            $this->save(isset($value["contenus"]["contenu"]["titre"]) ? $value["contenus"]["contenu"]["titre"] : null);
            $this->save( isset($value["contenus"]["contenu"]["sous_titre"]) ? $value["contenus"]["contenu"]["sous_titre"] : null );
            $this->save( isset($value["contenus"]["contenu"]["description_longue"]) ? $value["contenus"]["contenu"]["description_longue"] : null);
            $this->save( isset($value["contenus"]["contenu"]["description"]) ? $value["contenus"]["contenu"]["description"] : null);
            $this->save( isset($value["contenus"]["contenu"]["introduction"]) ? $value["contenus"]["contenu"]["introduction"] : null);
            $this->save( isset($value["contenus"]["contenu"]["description_courte"]) ? $value["contenus"]["contenu"]["description_courte"] : null);
            $this->save( isset($value["contenus"]["contenu"]["description_courte_opposition"]) ? $value["contenus"]["contenu"]["description_courte_opposition"] : null);
            $this->save( isset($value["contenus"]["contenu"]["libelle_facteur"]) ? $value["contenus"]["contenu"]["libelle_facteur"] : null);
            $this->save( isset($value["contenus"]["contenu"]["libelle_facteur_opposition"]) ? $value["contenus"]["contenu"]["libelle_facteur_opposition"] : null);            
            $this->save( isset($value["contenus"]["contenu"]["commentaire_perso"]) ? $value["contenus"]["contenu"]["commentaire_perso"] : null);
                    
            //setting all values to variable $data
        }
        
        return redirect()->route('import.index')->with('success', 'XML амжилттай татагдлаа!');
        // return $request->test_id;
        // test-deer assessment-daas duudaj avah! тухайн тестүүдийг Import хэсэгт xml файлаар хадгалаж харуулах!
        // тухайн файл insert хийгдсэн эсэхийг шалгана
        // хэрвээ хийгдсэн байвал тухайн утгуудыг дахин хийгүй
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save($str)
    {        
        // {{ dd($this->candidate_name); }}
        // if test_id already inserted in the db. what should we de?
        if($str !==null){
            $replaced = str_replace($this->candidate_name, "$", $str);        
            Translation::firstOrCreate([
                'test_id' => $this->test_id,
                'EN' => $replaced]);
        }
        // return true;
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
