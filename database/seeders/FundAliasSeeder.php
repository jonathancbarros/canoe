<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FundAliasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 30; $i++) {
            DB::table('fund_aliases')->insert([
                'name' => "Alias $i",
                'fund_id' => random_int(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
