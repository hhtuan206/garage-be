<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Vanguard\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'type' => 'logo',
            'content' => '',
        ]);
        Site::create([
            'type' => 'email',
            'content' => '',
        ]);
        Site::create([
            'type' => 'phone',
            'content' =>'',
        ]);
        Site::create([
            'type' => 'address',
            'content' => '',
        ]);
    }
}
