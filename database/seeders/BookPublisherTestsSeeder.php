<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class BookPublisherTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BookPublisher::create([
            'book_id' => (Book::whereNotNull('id')->first('id'))->id,
            'publisher_id' => (Publisher::whereNotNull('id')->first('id'))->id,
        ]);
    }
}
