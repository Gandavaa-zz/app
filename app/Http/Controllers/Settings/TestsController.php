<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Test;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;
use Exporter;
use Importer;

class TestsController extends Controller
{
    protected $test_type;
    protected $durations;

    public function __construct()
    {
        $this->middleware('auth');

        $this->test_type = config('app.test_type');
        $this->durations = config('app.durations');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tests = Test::paginate(15);

        if (request()->ajax()) {

            $data = Test::all();

            return FacadesDataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled"><li class="pr-1">
                    <a href="'.route("settings.test.show", $row->id).'" data-toggle="tooltip" data-id="'.$row->id.'" title="Харах" class="btn btn-secondary view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="'.route("settings.test.edit", $row->id).'" data-toggle="tooltip" data-id="'.$row->id.'" title="Засах" data-original-title="Edit" class="btn btn-primary btn-md" title="Edit">
                        <i class="cil-pencil"></i></a>
                    </li>
                    <li class="pr-1">
                        <form class="form-inline" action="'.route('settings.test.destroy', $row->id).'" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" title="Устгах" class="btn btn-danger" onclick="return confirm(\'Та энэ бичлэгийг үнэхээр устгах уу?\')"><i class="cil-trash"></i></button>
                        </form>
                    </li>
                    <li class="pr-1">
                        <a href="'.route("quiz.index", $row->id).'" class="btn btn-success btn-md">
                        <i class="cil-list"></i></a>
                    </li>

                </ul><input type="checkbox" id="'.$row->id.'"';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('layouts.settings.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.settings.test.create',
            [   
                'test_type' => $this->test_type,
                'durations' => $this->durations
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $this->validateTest();

        $test = Test::create($data);

        $part_titles =  $request->part_title;

        for ($i = 0; $i < count($part_titles); $i++) {
            $request->part_title[$i];
            $parts[]= array('num'=>$i, 'test_id'=>$test->id, 'title'=>$request->part_title[$i], 'info'=> $request->part_info[$i]);
        }

        $test->parts()->createMany($parts);

        return redirect()->route('settings.test')->with('success', 'Тестийг амжилттай бүртгэлээ!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        // return $test->parts;
        return view('layouts.settings.test.show',
                    [
                        'test'=> $test,
                        'test_type' => $this->test_type,
                        'durations' => $this->durations
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        return view('layouts.settings.test.edit',
                    ['test'=> $test,
                     'test_type'=> $this->test_type,
                     'durations' => $this->durations]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Test $test)
    {
        // validation here
        $this->validateTest();

        $test->title = request('title');
        $test->info = request('info');
        $test->type = request('type');
        $test->duration = request('duration');
        $test->save();

        for ($i = 0; $i < count(request('part_id')); $i++) {
            $test->parts[$i]->title=request('part_title')[$i];
            $test->parts[$i]->info=request('part_info')[$i];
            $test->push();
        }

        return redirect()->route('settings.test')->with('success', 'Тестийг засварлалаа!');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Test $test)
    {
        // check there is test has been registered user
        if($test->users())

            return back()->with('error', $test->title. "-энэ тест дээр хэрэглэгч бүртгэгдсэн тул устгах боломжгүй!");

        else{
            $test->delete();

            return back()->with('success', $test->title. "-г амжилттай устгалаа!");
        }

    }

    public function validateTest()
    {
        return request()->validate([
            'title' => ['required', ['string']],
            'info'=> ['required', ['string']],
            'type' => ['required', ['string']],
            'duration' => ['required', ['string']],
            'part_title' => ['required'],
            'part_info' => ['required']
        ]);
    }    

    public function import()
    {
        return view('layouts.settings.test.import', 
            [   
                'test_type' => $this->test_type,
                'durations' => $this->durations
            ]);
    }

    public function importExcel(Request $request)
    {
        $request->validate(
            [
                'file'=>'required|max:5000|mimes:xlsx,xls,csv'
            ]);

        $excelFile = time().'.'.$request->file('file')->extension();

        $file = $request->file('file')->storeAs('uploads/excels', $excelFile, 'public');

        $excels = Importer::make('Excel')->load('storage/'.$file)->getCollection();
        
        if($excels){
            foreach($excels as $row){
                try{
                    dump ($row);

                }catch(\Exception $e){
                    return back();
                }
            }

        }
        // return back()->with('success', "Excel файлыг амжилттай импортлолоо!");
    }
    
    
}
