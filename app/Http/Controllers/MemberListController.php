<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Card;
use Illuminate\Http\Request;

class MemberListController extends Controller
{
    public function index()
    {
        $users = User::with('card')->get();
        return view('memberlist', compact('users'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Find the user by ID
            $user = User::findOrFail($id);
    
            // Update user fields
            $user->update([
                'name' => $request->input('name', $user->name),
                'email' => $request->input('email', $user->email),
            ]);
    
            // Update or create card fields
            $user->card()->updateOrCreate([], [
                'rfid_tag' => $request->input('rfid_tag', $user->card->rfid_tag ?? null),
                'status' => $request->input('status', $user->card->status ?? null),
            ]);
    
            return redirect()->route('memberlist')->with('success', 'User updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('memberlist')->with('error', 'Failed to update user. Please try again.');
        }
    }
    

    public function destroy(User $user)
    {
        try {
            // Delete the user's associated card if it exists
            if ($user->card) {
                $user->card->delete();
            }

            // Delete the user
            $user->delete();

            return redirect()->route('memberlist')
                ->with('success', 'User and associated card deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('memberlist')
                ->with('error', 'Failed to delete the user. Please try again.');
        }
    }
}
