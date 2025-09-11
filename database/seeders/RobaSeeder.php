<?php

namespace Database\Seeders;

use App\Models\Roba;
use Illuminate\Database\Seeder;

class RobaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roba::factory()
            ->count(5)
            ->create();
    }
}
