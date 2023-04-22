<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $users = User::with('scores') // load the 'scores' relationship
        ->join('scores', 'users.id', '=', 'scores.user_id') // join the 'scores' table
        ->orderByDesc('scores.pitchers')
            ->get(['users.*']); // select only the columns from the 'users' table

        return view('leaderboard', compact('users'));
    }
}
