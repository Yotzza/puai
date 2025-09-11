<?php

namespace Database\Seeders;

use App\Models\Izvestaj;
use Illuminate\Database\Seeder;

class IzvestajSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Izvestaj::factory()
            ->count(5)
            ->create();
    }
}
