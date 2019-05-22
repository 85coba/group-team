<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Match;
use App\Team;
use App\Group;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $id = $request->groupID;
        dump($id);
        $group = Group::find($id);
        $teams = $group->teams->all();
        $i = 0;
        foreach ($teams as $team){
            $teamArr[$i] = $team->name;
            $i++;
        }

        $len = count($teamArr);
        $matches=[];
        for ($i = 0; $i < $len; $i++) {
            for ($j = $i+1; $j < $len; $j++){
                $match = new Match;
                $match->team1 = $teamArr[$i];
                $match->team2 = $teamArr[$j];
                $match->group_id = $id;
                $match->save();
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
        $match = Match::find($id);
        switch ($request->team) {
            case 1:
                $match->team1_point = $request->point;
                $match->save();
                break;
            case 2:
                $match->team2_point = $request->point;
                $match->save();
                break;
        }
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
