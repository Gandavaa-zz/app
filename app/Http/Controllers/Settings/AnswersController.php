<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quiz;
use App\Answer;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class AnswersController extends Controller
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
    public function index(Quiz $quiz)
    {
        $quizzes = Quiz::get();

        if (request()->ajax()) {

            $data = $quiz->answers;

            return FacadesDataTables::of($data)
            
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled"><li class="pr-1">
                    <a href="'.route("answer.show", ['quiz'=>$row->quiz_id, 'answer'=>$row->id]).'" data-toggle="tooltip" data-id="'.$row->id.'" class="btn btn-secondary view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="'.route("answer.edit", $row->id).'" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-md" title="Edit">
                        <i class="cil-pencil"></i></a>
                    </li>
                    <li class="pr-1">
                        <form class="form-inline" action="'.route('answer.destroy', $row->id).'" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.csrf_token().'">
                            <button type="submit" class="btn btn-danger" onclick="return confirm(\'Та энэ бичлэгийг үнэхээр устгах уу?\')"><i class="cil-trash"></i></button>
                        </form>
                    </li>                    
                </li>
                </ul><input type="checkbox" id="'.$row->id.'"';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('layouts.settings.answer.index', compact('quizzes', 'quiz'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Quiz $quiz)
    {
            return view('layouts.settings.answer.create', 
            [
                'quiz' => $quiz                
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {  
        $data = $this->validateAnswer();

        if($request->has('image')) $data['answer_path'] = $this->validateImage($request);

        Answer::create($data);

        return redirect()->route('answer.index', $data['quiz_id'])->with('success', 'Асуултыг амжилттай бүртгэлээ!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {        
        return view('layouts.settings.answer.show', ['answer'=> $answer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        return view('layouts.settings.answer.edit',['answer'=> $answer]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Answer $answer)
    {
        $this->validateAnswer();

        $answer->quiz_id = request('quiz_id');
        $answer->number = request('number');        
        $answer->answer = request('answer');
        if(request('image')) $answer->image = request('image');                
        $answer->save();

        return redirect()->route('answer.index', request('quiz_id'))->with('success', 'Асуултыг амжилттай шинэчлэлээ!');

    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Answer $answer)
    {
        if($answer->quiz->test->users)
             request()->session()->flash('error', " '". $answer->quiz->test->title. "' -энэ тест дээр хэрэглэгч бүртгэгдсэн байгаа тул устгах боломжгүй!");    
         else{
             $answer->delete();
             request()->session()->flash('success', $answer->answer. "-г амжилттай устгалаа!");
         }
        
        return back();

    }

    public function validateAnswer()
    {
        return request()->validate([
            'quiz_id' => ['required'],
            'number'=> ['required', ['numeric']],
            'answer' => ['required', ['string']]
        ]);
    }   

    public function validateImage($request){
        
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,bmp,png|max:10240'
        ]);

        $imageFile = time().'.'.$request->file('image')->extension();

        $filePath = $request->file('image')->storeAs('uploads', $imageFile, 'public');

        return $filePath;          
    }
}
