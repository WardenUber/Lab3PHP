<?php

namespace Database\Seeders;

use App\Models\Dealership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dealership::factory(100)->create();
    }
}
