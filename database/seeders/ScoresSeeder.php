<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\DrinkSession;
use App\Models\Score;
use App\Models\Card;
use Carbon\Carbon;

class ScoresSeeder extends Seeder
{
    public function run()
    {
        // Create users with specific names
        $users = collect([
            ['name' => 'Jason', 'email' => 'jason@example.com'],
            ['name' => 'Todd', 'email' => 'todd@example.com'],
            ['name' => 'Bruce', 'email' => 'bruce@example.com'],
        ])->map(function ($userData) {
            return User::factory()->create($userData);
        });

        // Example session data
        $exampleData = [
            [
                'name' => 'Jason',
                'sessions' => [
                    ['date' => '2025-01-01', 'pitchers' => 3],
                    ['date' => '2025-01-02', 'pitchers' => 4],
                ],
            ],
            [
                'name' => 'Todd',
                'sessions' => [
                    ['date' => '2025-01-01', 'pitchers' => 2],
                    ['date' => '2025-01-02', 'pitchers' => 3],
                ],
            ],
            [
                'name' => 'Bruce',
                'sessions' => [
                    ['date' => '2025-01-01', 'pitchers' => 1],
                    ['date' => '2025-01-02', 'pitchers' => 2],
                ],
            ],
        ];

        foreach ($exampleData as $data) {
            $user = $users->firstWhere('name', $data['name']);
            if (!$user) {
                continue;
            }

            // Create a card for the user
            Card::create([
                'user_id' => $user->id,
                'rfid_tag' => uniqid(),
                'status' => 'Active',
                'issue_date' => Carbon::now(),
                'expiry_date' => Carbon::now()->addYear(),
            ]);

            // Initialize the user's total pitchers
            $totalPitchers = 0;

            // Create drink sessions for the user
            foreach ($data['sessions'] as $sessionData) {
                DrinkSession::create([
                    'user_id' => $user->id,
                    'session_date' => Carbon::parse($sessionData['date']),
                    'check_in_time' => '08:00:00',
                    'check_out_time' => '17:00:00',
                    'pitchers' => $sessionData['pitchers'],
                ]);

                $totalPitchers += $sessionData['pitchers'];
            }

            // Update the user's score
            Score::updateOrCreate(
                ['user_id' => $user->id],
                ['pitchers' => $totalPitchers]
            );
        }
    }
}
