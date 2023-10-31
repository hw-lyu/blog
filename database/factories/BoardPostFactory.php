<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\BoardPost;
use App\Models\BoardTagList;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardPostFactory extends Factory
{
    protected $model = BoardPost::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $board = Board::get();
        $boardTag = BoardTagList::get();

        return [
            'subject' => $this->faker->word(),
            'content' => $this->faker->randomHtml(),
            'file_data' => json_encode("{'url' : '//placehold.co/800@2x.png', 'extension': 'png', 'type' : ' image/png', 'name' : '800@2x.png', 'size' : 0}"),
            'board_id' => $this->faker->numberBetween(1, $board->count()),
            'tag_id' => $this->faker->numberBetween(1, $boardTag->count()),
            'writer' => 'lumii',
            'use' => $this->faker->numberBetween(0, 1)
        ];
    }
}
