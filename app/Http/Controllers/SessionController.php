<?php

namespace App\Http\Controllers;

use App\Models\DrinkSession;
use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\User;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        // Fetch all unique session dates
        $sessionDates = DrinkSession::select('session_date')
            ->distinct()
            ->orderByDesc('session_date')
            ->pluck('session_date');

        // Check if there's session data for today
        $today = now()->toDateString();
        $hasTodaySessions = DrinkSession::where('session_date', $today)->exists();

        return view('sessions', [
            'sessionDates' => $sessionDates,
            'defaultDate' => $hasTodaySessions ? $today : null,
        ]);
    

        // Fetch session details for the selected date
        $selectedDate = $request->get('session_date');
        $sessionDetails = DrinkSession::with('user') // Load related user data
            ->where('session_date', $selectedDate)
            ->orderBy('check_in_time')
            ->get();

        // Format session dates as an array for easy use in JavaScript
        $highlightDates = $sessionDates->map(function ($date) {
            return $date->format('Y-m-d');
        });

        return view('sessions', compact('highlightDates', 'sessionDetails', 'selectedDate'));
    }

    public function handleCard(Request $request)
    {
        $uid = $request->input('uid');
        $option = $request->input('option');
        $currentDate = now()->toDateString();

        if (!$uid || $option === null) {
            return response()->json(['status' => 'error', 'message' => 'UID or option not provided'], 400);
        }

        // Find user by card UID
        $card = Card::where('rfid_tag', $uid)->first();
        if (!$card) {
            return response()->json(['status' => 'error', 'message' => 'Card not found'], 404);
        }

        $userID = $card->user_id;

        // Handle options
        if ($option == "0") {
            // Clock In
            $session = DrinkSession::where('user_id', $userID)
                ->where('session_date', $currentDate)
                ->first();

            if ($session && !$session->check_out_time) {
                return response()->json(['status' => 'error', 'message' => 'User already checked in']);
            }

            if ($session && $session->check_out_time) {
                return response()->json(['status' => 'error', 'message' => 'User already checked out']);
            }

            DrinkSession::create([
                'user_id' => $userID,
                'pitchers' => 0,
                'session_date' => $currentDate,
                'check_in_time' => now()->toTimeString(),
            ]);

            return response()->json([
                'status' => 'success',
                'action' => 'checked_in',
                'message' => 'User checked in',
                'name' => $card->user->name,
            ]);
        } elseif ($option == "1") {
            // Clock Out
            $session = DrinkSession::where('user_id', $userID)
                ->where('session_date', $currentDate)
                ->whereNull('check_out_time')
                ->first();

            if (!$session) {
                return response()->json(['status' => 'error', 'message' => 'User not checked in']);
            }

            $session->update(['check_out_time' => now()->toTimeString()]);

            return response()->json([
                'status' => 'success',
                'action' => 'checked_out',
                'message' => 'User checked out',
                'name' => $card->user->name,
            ]);
        } elseif ($option == "2") {
            // Add Pitcher
            $session = DrinkSession::where('user_id', $userID)
                ->where('session_date', $currentDate)
                ->whereNull('check_out_time')
                ->first();

            if (!$session) {
                return response()->json(['status' => 'error', 'message' => 'User not checked in, cannot add pitcher']);
            }

            $session->increment('pitchers');

            return response()->json([
                'status' => 'success',
                'action' => 'added_pitcher',
                'message' => 'Pitcher added',
                'name' => $card->user->name,
                'newPitcherCount' => $session->pitchers,
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Invalid option'], 400);
        }
    }
}
