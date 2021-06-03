<?php

namespace App\Http\Controllers;

use App\Translation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\TestAPI;
use Illuminate\Support\Facades\Storage;
class TranslationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $translations = Translation::get();
        if ($request->ajax()) {
            $data = Translation::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled"><li class="pr-1">
                    <a href="' . route("translations.show", $row->id) . '"
                        data-toggle="tooltip"
                        data-id="' . $row->id . '" class="btn btn-secondary view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="' . route("translations.edit", $row->id) . '"
                            data-toggle="tooltip"
                            data-id="' . $row->id . '"
                            data-original-title="Edit"
                            class="btn btn-primary btn-md" title="Засах">
                        <i class="cil-pencil"></i></a>
                    </li>
                    <li class="pr-1">
                        <form class="form-inline" action="' . route('translations.destroy', $row->id) . '" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <button type="submit" class="btn btn-danger" title="Устгах" onclick="return confirm(\'Та энэ бичлэгийг үнэхээр устгах уу?\')"><i class="cil-trash"></i></button>
                        </form>
                    </li>
                </ul><input type="checkbox" id="' . $row->id . '"';

                    return $btn;
                })
            // ->addColumn('name', function($row) {
            //     $options = '';
            //     $myArray = explode(',', $row->name);
            //     foreach ($myArray as $name) {
            //         $options .= $name;
            //     }
            //     $return = $options;
            //     return $return;
            // })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.translation.index', compact("translations"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assessments = TestAPI::all(['id', 'label']);
        return view('layouts.translation.create', compact('assessments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateInputs();
        // dd($data);
        $data = Translation::create($data);
        return redirect()->route('translations.index')->with('success', 'Асуултыг амжилттай бүртгэлээ!');
    }

    public function getJSON($id) 
    {      
        $data = [];
        $data2 = [];
        $contents = Storage::get("assets/assessments/901903.xml");
        // $decrypted= Crypt::decryptString($contents);
        $xml = xml_decode($contents);
             // get test factor results done
     
        $xml = xml_decode($contents);
        // dd($xml['elements']['test_tests']);
      
            // dd($xml["elements"]["test_tests"]["test_test"]["@attributes"]["id"]);
            $data['general'] = [
                'test_id' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["id"],
                'score' => $xml["elements"]["test_tests"]["test_test"]["@attributes"]["score_calcule"],
                'label' => $xml["elements"]["test_tests"]["test_test"]["contenus"]["contenu"]["libelle"],
                'participant_name' =>$xml["noyau_utilisateur_info"]["nom"] . " " .  $xml["noyau_utilisateur_info"]["prenom"]
            ];

         
            foreach($xml['elements']['test_facteurs']['test_facteur'] as $value){
                $data2[] = 
                [
                    'id' => $value["@attributes"]["id"],
                    'score' =>$value["@attributes"]["score_calcule"],
                    'label' =>$value["contenus"]["contenu"]["libelle"],
                ];
        }
        $data['test_factors'] = $data2;

        foreach($xml['elements']['test_groupe_facteurs']['test_groupe_facteur'] as $value){
            $data2[] = 
            [
                'id' => $value["@attributes"]["id"],
                'score' =>$value["@attributes"]["score_calcule"],
                'label' =>$value["contenus"]["contenu"]["libelle"],
            ];
    }   
    $data['test_group_factors'] = $data2;
        
    $data['test_mini_tests'] = [
        'id' => $xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["id"],
        'score' =>$xml["elements"]["test_mini_tests"]["test_mini_test"]["@attributes"]["score_calcule"],
    ];


        dd($data);
        return $xml;
        // $texts = 
        // return json_encode($states);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Translation $translation)
    {
        return view('layouts.translation.show', ['translation' => $translation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Translation $translation)
    {
        return view('layouts.translation.edit', ['translation' => $translation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Translation $translation)
    {

        $translation->update($this->validateInputs());
        return redirect()->route('translations.index', request('id'))->with('success', 'Орчуулгыг амжилттай шинэчлэлээ!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $translation = Translation::findOrFail($id);
        $translation->delete();
        return back()->with('success', "Aмжилттай устгалаа!");
    }

    public function validateInputs()
    {
        return request()->validate([
            'test_id' => ['required'],
            'en' => ['required', ['string']],
            'mn' => ['required', ['string']],
        ]);
    }
}
