<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublisherTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Publisher::create([
            'name' => 'Test Publisher',
            'full_name' => 'Test Publisher',
        ]);
    }
}
