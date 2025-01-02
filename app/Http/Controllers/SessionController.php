<?php

namespace App\Http\Controllers;

use App\Models\DrinkSession;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all unique session dates
        $sessionDates = DrinkSession::select('session_date')
            ->distinct()
            ->orderByDesc('session_date')
            ->pluck('session_date');

        // Fetch session details for the selected date
        $selectedDate = $request->get('session_date');
        $sessionDetails = DrinkSession::with('user') // Load related user data
            ->where('session_date', $selectedDate)
            ->orderBy('check_in_time')
            ->get();

        return view('sessions', compact('sessionDates', 'sessionDetails', 'selectedDate'));
    }
}
