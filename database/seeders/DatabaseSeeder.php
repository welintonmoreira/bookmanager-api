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
        $this->call([
            AuthorTestsSeeder::class,
            PublisherTestsSeeder::class,
            BookTestsSeeder::class,
            BookPublisherTestsSeeder::class,
            BookAuthorTestsSeeder::class,
        ]);
    }
}
