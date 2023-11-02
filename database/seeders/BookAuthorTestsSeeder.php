<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;

class BookAuthorTestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\BookAuthor::create([
            'book_id' => (Book::whereNotNull('id')->first('id'))->id,
            'author_id' => (Author::whereNotNull('id')->first('id'))->id,
        ]);
    }
}
