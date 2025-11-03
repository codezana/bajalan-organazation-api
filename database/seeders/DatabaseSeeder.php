<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Members,Equipment, Decisions,Departures,Accounting};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Members::factory(10)->create();
        Equipment::factory(10)->create();
        Decisions::factory(10)->create();
        Departures::factory(10)->create();
        Accounting::factory(10)->create();

    }
}
