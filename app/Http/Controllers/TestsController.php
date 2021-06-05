<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use PhpOffice\PhpSpreadsheet\Calculation\Database;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $tests = Test::paginate(15);

        if (request()->ajax()) {

            $data = DB::select('select tb1.id, date(tb1.created_at) as created_at, tb1.firstname, tb1.email, tb1.phone, tb3.name from users as tb1 left join group_user as tb2 on tb1.id = tb2.user_id left join groups as tb3 on tb2.id = tb3.id order by tb1.created_at desc');

            return FacadesDataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '
                    <ul class="list-group list-group-horizontal list-unstyled"><li class="pr-1">
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" class="btn btn-success view btn-md">
                        <i class="cil-magnifying-glass"></i>
                        </a>
                    </li>
                    <li class="pr-1">
                        <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Edit" class="btn btn-primary btn-md" title="test"><i class="cil-user"></i></a>
                    </li>
                    <li class="pr-1">
                    <div class="btn-group">
                    <a href="" type="button" title="Бусад" class="btn btn-secondary  dropdown-toggle  btn-sm" data-toggle="dropdown">
                    <i class="cil-cog"></i>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item edit" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit">Edit</a>
                        <a class="dropdown-item" href="javascript:void(0)">Assessment</a>
                        <a class="dropdown-item" href="javascript:void(0)">Add to the group</a>
                        <a class="dropdown-item delete" style="color:red;" href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete">Delete</a>
                    </div>
                  </div>
                </li>
                </ul><input type="checkbox" id="'.$row->id.'"';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('layouts.test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $test_type = config('app.test_type');
        return view('layouts.settings.test.create', compact('test_type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit($id)
    {
        $test_type = config('app.test_type');

        return view('admin.tests.edit', compact('test', 'test_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy($id)
    {
        //
    }


}
