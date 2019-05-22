<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Team;
use App\Match;

class Groups extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show all Groups

        return  Group::all();
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create new group.

        $availabel_names = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        $AllGroup = Group::all();

        $namesUsed = $AllGroup->reject(function ($group) {
            return $group->active === false;
        })
            ->map(function ($group) {
                return $group->name;
            })->toArray();


        foreach ($availabel_names as $name) {
            if (!(in_array($name, $namesUsed))) {
                $newGroup = new Group;
                $newGroup->name = $name;
                $newGroup->save();
                break;
            }

        }

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
        $group = Group::find($id);

        $teams = $group->teams->all();

        $matches = $group->matches->all();

        $response = ['teams' => $teams, 'matches' => $matches];

        return $response;
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
        //Delete group by id, and all nested models

        $group = Group::find($id);
        $teams = $group->teams->all();
        foreach ($teams as $team)
            Team::destroy($team->id);
        $matches = $group->matches->all();
        foreach ($matches as $match)
            Match::destroy($match->id);
        Group::destroy($id);

        return response()->json(['error' => false]);
    }
}
