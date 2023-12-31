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
            BoardSeeder::class,
            BoardTagListSeeder::class,
            BoardPostSeeder::class,
            BoardPostTagSeeder::class
        ]);
    }
}
