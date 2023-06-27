<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AuthorTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Author::create([
            'name' => 'Test Author',
        ]);
    }
}
