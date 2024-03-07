<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            DB::table('funds')->insert([
                'name' => "Fund $i",
                'start_year' => random_int(1995, 2024),
                'fund_manager_id' => random_int(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
