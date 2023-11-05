<?php

namespace Database\Seeders;

use App\Models\BoardPostTag;
use Illuminate\Database\Seeder;

class BoardPostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->GetBoardPostTag();

        foreach($data as $boardPostTag) {
            BoardPostTag::insert($boardPostTag);
        }
    }

    /**
     * 게시판 포스트와 게시판 태그 리스트를 매칭시키는 값을 가져온다.
     *
     * @return array
     */
    public function GetBoardPostTag() : array {
        return [
            [
                'board_id' => 1,
                'tag_id' => 1,
                'use' => true
            ],
            [
                'board_id' => 2,
                'tag_id' => 2,
                'use' => true
            ],
            [
                'board_id' => 3,
                'tag_id' => 3,
                'use' => true
            ],
            [
                'board_id' => 2,
                'tag_id' => 4,
                'use' => true
            ],
            [
                'board_id' => 4,
                'tag_id' => 4,
                'use' => true
            ],
            [
                'board_id' => 2,
                'tag_id' => 5,
                'use' => true
            ],
            [
                'board_id' => 5,
                'tag_id' => 5,
                'use' => true
            ],
            [
                'board_id' => 2,
                'tag_id' => 6,
                'use' => true
            ],
            [
                'board_id' => 6,
                'tag_id' => 6,
                'use' => true
            ],
        ];
    }
}
