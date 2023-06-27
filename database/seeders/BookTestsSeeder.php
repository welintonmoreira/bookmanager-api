<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Book::create([
            'title' => 'Test Book',
            'original_title' => 'original title',
            'subtitle' => 'Test',
            'original_subtitle' => 'original subtitle',
            'publication_year' => '2023',
            'number_pages' => '233',
            'edition_number' => '4',
            'synopsis' => 'Test',
            'height' => '225',
            'width' => '103',
            'thickness' => '48',
            'weight' => '137',
        ]);
    }
}
