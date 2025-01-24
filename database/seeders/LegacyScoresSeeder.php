<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LegacyScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for scoresy1
        DB::table('scoresy1')->insert([
            ['user_id' => 1, 'pitchers' => 6, 'shame' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'pitchers' => 8, 'shame' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'pitchers' => 10, 'shame' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Sample data for scoresy2
        DB::table('scoresy2')->insert([
            ['user_id' => 1, 'pitchers' => 5, 'shame' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'pitchers' => 9, 'shame' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'pitchers' => 12, 'shame' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
