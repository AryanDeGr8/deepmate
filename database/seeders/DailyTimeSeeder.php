<?php

namespace Database\Seeders;

use App\Models\DailyTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DailyTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DailyTime::factory(50)->create();
    }
}
