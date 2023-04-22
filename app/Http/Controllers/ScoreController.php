<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class ScoreController extends Controller
{
    public function index()
    {
        $users = User::with('scores') // load the 'scores' relationship
        ->join('scores', 'users.id', '=', 'scores.user_id') // join the 'scores' table
        ->get(['users.*']); // select only the columns from the 'users' table

        return view('score-registration', compact('users'));
    }

    public function store(Request $request)
    {
        // Get the selected user from the dropdown
        $user = User::find($request->input('user_id'));

        // Update or create the score record for the user
        $user->scores()->updateOrCreate(
            [],
            [
                'pitchers' => $user->scores->pitchers + $request->input('pitchers'),
                'shame' => $user->scores->shame + $request->input('shame'),
            ]
        );

        return redirect()->back()->with('success', 'Scores updated successfully');
    }
}
