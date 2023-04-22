<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->administrator) {
            // Authentication passed..
            $users = User::all();
            return view('pitch-reg', compact('users'));
        } else {
            abort(404);
        }
    }

    public function create()
    {
        $users = User::pluck('name', 'id');

        return view('posts.create', compact('users'));
    }

    public function store(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->pitchers += $request->pitchers;
        $user->shame_score += $request->shame_score;

        $user->save();

        return redirect()->route('create.post')->with('success', 'Post created successfully.');
    }

}
