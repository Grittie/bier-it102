<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Card;
use Illuminate\Support\Facades\Auth;

class EditCardUid extends Component
{
    public $currentCardUid;
    public $newCardUid;

    protected $rules = [
        'newCardUid' => 'required|string|max:255',
    ];

    public function mount()
    {
        $userId = Auth::id(); // Get the currently logged-in user's ID
        $this->currentCardUid = Card::where('user_id', $userId)->value('rfid_tag');
        $this->newCardUid = $this->currentCardUid;
    }

    public function updateCardUid()
    {
        $this->validate();

        $userId = Auth::id(); // Get the currently logged-in user's ID

        $card = Card::where('user_id', $userId)->first();
        if ($card) {
            // Update existing entry
            $card->update(['rfid_tag' => $this->newCardUid]);
        } else {
            // Create a new entry if none exists
            Card::create([
                'user_id' => $userId,
                'rfid_tag' => $this->newCardUid,
            ]);
        }

        $this->currentCardUid = $this->newCardUid;
        session()->flash('message', 'Card UID updated successfully.');
    }

    public function render()
    {
        return view('livewire.edit-card-uid');
    }
}
