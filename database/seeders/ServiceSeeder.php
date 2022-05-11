<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanguard\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::factory(20)->create();
    }
}
