<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\BoardPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

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
        $boardContent = $this->faker->paragraphs(12);

        foreach($boardContent as $key => $content) {
            $boardContent[$key] = "<p>{$content}</p>";
        }

        $contentStr = $boardContent[rand(0, count($boardContent) - 1)];

        return [
            'subject' => $this->faker->word(),
            'content' => $contentStr,
            'strip_content' => strip_tags($contentStr),
            'file_data' => json_encode(['url' => '//placehold.co/800@2x.png', 'extension' => 'png', 'type' => 'image/png', 'name' => '800@2x.png', 'size' => 0]),
            'board_id' => Board::inRandomOrder()->first()->id,
            'writer' => 'lumii',
            'use' => $this->faker->numberBetween(0, 1)
        ];
    }
}
