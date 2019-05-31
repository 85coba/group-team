<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Match;
use App\Team;
use App\Group;

class MatchesController extends Controller
{
    public function store(Request $request)
    {
        // Create list of matches

        $id = $request->groupID;
        $group = Group::find($id);
        $matches = $group->matches->all();

        foreach ($matches as $match) {
            Match::destroy($match->id);
        }


        $teams = $group->teams->all();
        $i = 0;
        foreach ($teams as $team) {
            $teamArr[$i] = $team->name;
            $i++;
        }
        $len = count($teamArr);
        $matches = [];
        for ($i = 0; $i < $len; $i++) {
            for ($j = $i + 1; $j < $len; $j++) {
                $match = new Match;
                $match->team1 = $teamArr[$i];
                $match->team2 = $teamArr[$j];
                $match->group_id = $id;
                $match->team1_point = 0;
                $match->team2_point = 0;
                array_push($matches, $match);
                $match->save();
            }
        }
        return $matches;
    }

    public function update(Request $request, $groupID, $id)
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
}
