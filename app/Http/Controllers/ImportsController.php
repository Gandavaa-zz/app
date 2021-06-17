<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Test;
use Illuminate\Http\Request;

class ImportsController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return $request->test_id;
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
    public function show($id)
    {
        //
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
