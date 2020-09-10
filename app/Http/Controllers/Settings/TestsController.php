<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Test;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

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
                    <a href="'.route("settings.test.show", $row->id).'" data-toggle="tooltip" data-id="'.$row->id.'" class="btn btn-secondary view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="'.route("settings.test.edit", $row->id).'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-md" title="Edit">
                        <i class="cil-pencil"></i></a>
                    </li>
                    <li class="pr-1">
                        <form class="form-inline" action="'.route('settings.test.destroy', $row->id).'" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger" onclick="return confirm(\'Та энэ бичлэгийг үнэхээр устгах уу?\')"><i class="cil-trash"></i></button>
                        </form>
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
            ['test_type' => $this->test_type,
             'durations' => $this->durations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $this->validateTest();

        Test::create($data);

        $request->session()->flash('message', 'Тестийг амжилттай бүртгэлээ!');

        return redirect()->route('settings.test');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
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

        request()->session()->flash('message', 'Тестийг амжилттай шинэчлэлээ!');

        return redirect()->route('settings.test');

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Test $test)
    {
        $test->delete();

        request()->session()->flash('message', $test->title. "-г амжилттай устгалаа!");

        return back();
    }

    public function validateTest()
    {
        return request()->validate([
            'title' => ['required', ['string']],
            'info' => ['required', ['string']],
            'type' => ['required', ['string']],
            'duration' => ['required', ['string']]
        ]);
    }
}
