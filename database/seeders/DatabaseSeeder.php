<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(IzvestajSeeder::class);
        $this->call(RobaSeeder::class);
        $this->call(TransakcijaSeeder::class);
        $this->call(ZaposleniSeeder::class);
    }
}
