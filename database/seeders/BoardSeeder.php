<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getBoardList();

        foreach($data as $board) {
            Board::insert($board);
        }
    }

    /**
     * 게시판 리스트 정보
     *
     * @return array
     */
    public function getBoardList() : array
    {
        return [
            [
                'name' => 'About Me',
                'name_ko' => "나에 대해서",
                'parent_id' => 1,
                'depth' => 1,
                'order' => 1,
                'use' => true
            ],
            [
                'name' => 'Blog',
                'name_ko' => "블로그",
                'parent_id' => 2,
                'depth' => 1,
                'order' => 1,
                'use' => true
            ],
            [
                'name' => 'Etc',
                'name_ko' => "기타",
                'parent_id' => 3,
                'depth' => 1,
                'order' => 1,
                'use' => true
            ],
            [
                'name' => 'Development',
                'name_ko' => "개발",
                'parent_id' => 2,
                'depth' => 2,
                'order' => 1,
                'use' => true
            ],
            [
                'name' => 'Life',
                'name_ko' => "삶",
                'parent_id' => 2,
                'depth' => 2,
                'order' => 3,
                'use' => true
            ],
            [
                'name' => 'Review',
                'name_ko' => "리뷰",
                'parent_id' => 2,
                'depth' => 2,
                'order' => 2,
                'use' => true
            ]
        ];
    }
}
