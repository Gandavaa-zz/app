<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quiz;
use App\Test;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;


class QuizzesController extends Controller
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
    public function index(Test $test)
    {
        $tests = Test::get();

        if (request()->ajax()) {

            $data = $test->quizzes;

            return FacadesDataTables::of($data)
            
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled"><li class="pr-1">
                    <a href="'.route("quiz.show", ['test'=>$row->test_id, 'quiz'=>$row->id]).'" data-toggle="tooltip" data-id="'.$row->id.'" class="btn btn-secondary view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="'.route("quiz.edit", ['test'=>$row->test_id, 'quiz' =>$row->id]).'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-md" title="Edit">
                        <i class="cil-pencil"></i></a>
                    </li>
                    <li class="pr-1">
                        <form class="form-inline" action="'.route('quiz.destroy', $row->id).'" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger" onclick="return confirm(\'Та энэ бичлэгийг үнэхээр устгах уу?\')"><i class="cil-trash"></i></button>
                        </form>
                    </li>
                    <li class="pr-1">
                        <a href="'.route("answer.index", $row->id).'" class="btn btn-success btn-md">
                    <i class="cil-list-rich"></i></a>                        
                </li>
                </ul><input type="checkbox" id="'.$row->id.'"';



                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('layouts.settings.quiz.index', compact('tests', 'test'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Test $test)
    {
        return view('layouts.settings.quiz.create',
            [   'test' => $test,
                'test_type' => $this->test_type,
                'durations' => $this->durations
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  

        $data = $this->validateQuiz();

        if($request->has('image')) $this->validateImage($request);

        Quiz::create($data);

        return redirect()->route('quiz.index', $data['test_id'])->with('flash', 'Асуултыг амжилттай бүртгэлээ!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test, Quiz $quiz)
    {        
        return view('layouts.settings.quiz.show',
                    [
                        'test'=> $test,
                        'quiz'=> $quiz,
                        'test_type' => $this->test_type,
                        'durations' => $this->durations
                    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test, Quiz $quiz)
    {
        return view('layouts.settings.quiz.edit',
                    [
                        'test'=> $test,
                        'quiz'=> $quiz,
                        'test_type'=> $this->test_type,
                        'durations' => $this->durations
                    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, Quiz $quiz)
    {
        $this->validateQuiz();

        $data = [
            'number' => $request->input('number'),
            'quiz' => $request->input('quiz')
        ];
        
        if($request->has('image'))         
            $data['quiz_path'] = $this->validateImage($request);        

        $quiz->update($data);       
        
        return redirect()->route('quiz.index', $request->input('test_id'))->with('success', 'Асуултыг амжилттай шинэчлэлээ!');

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Quiz $quiz)
    {
        // return $test->users;
        if($quiz->test->users)
             return back()->with('error', " '". $quiz->test->title. "' -энэ тест дээр хэрэглэгч бүртгэгдсэн байгаа тул устгах боломжгүй!");    
         else{
             $quiz->delete();
             return back()->with('success', $quiz->title. "-г амжилттай устгалаа!");
         }

    }

    public function validateQuiz()
    {
        return request()->validate([
            'test_id' => ['required'],
            'number'=> ['required', ['numeric']],
            'quiz' => ['required', ['string']]
        ]);
    }

    public function validateImage($request){
        
            $request->validate([
                'image' => 'required|mimes:jpg,jpeg,bmp,png|max:2048'
            ]);

            $imageFile = time().'.'.$request->file('image')->extension();

            $filePath = $request->file('image')->storeAs('uploads', $imageFile, 'public');

        return $filePath;           
        
    }
    
       
}
