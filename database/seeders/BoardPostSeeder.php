<?php

namespace Database\Seeders;

use App\Models\BoardPost;
use Illuminate\Database\Seeder;

class BoardPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BoardPost::factory()->count(50)->create();
    }
}
