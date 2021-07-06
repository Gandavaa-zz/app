<?php

namespace App\Http\Controllers\Settings;

use App\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GroupsController extends Controller
{
    /**
     * Хэрвээ групп байвал шууд харуулна хэрвээ аль хэдийн групп нэмэгдсэн
     * байвал тухайн шинэ групп-ыг шинэ групп-д нэмж харуулья
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::withHeaders([
            'WWW-Authenticate' => $this->token
        ])->get('https://app.centraltest.com/customer/REST/list/group/json');

        $api_groups = json_decode($response, true);
        // https://app.centraltest.com/customer/REST/list/group/ [FORMAT]

        // insert groups into group
        foreach ($api_groups as $key => $group) {
            if (!Group::where('id', intval($group['id']))->exists()) {
                Group::create([
                    'id' => $group['id'],
                    'name' => $group['name']
                ]);
            }
        }

        $groups = Group::paginate(15);

        // return $groups;
        return view('layouts.settings.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('layouts.settings.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $data = $this->validateGroup();

        $group = Group::create($data);

        return redirect()->route('group.index')->with('sucess', 'Хэрэглэгчийг амжилттай бүртгэлээ!');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(Group $group)
    {
        return view('layouts.settings.group.show', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function edit(Group $group)
    {
        return view('layouts.settings.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Group $group)
    {
        $group->update($this->validateGroup());

        return redirect()->route('group.index')->with('success', 'Группын мэдээллийг амжилттай засварлалаа!');
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return redirect()->route('group.index')->with('success', 'Группын мэдээллийг амжилттай устгалаа!');
    }

    public function validateGroup()
    {
        return request()->validate([
            'name' => ['required', ['string']]
        ]);
    }
}
