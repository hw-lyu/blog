<?php

namespace Database\Seeders;

use App\Models\BoardTagList;
use Illuminate\Database\Seeder;

class BoardTagListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = $this->getBoardTagList();

        foreach ($data as $board) {
            BoardTagList::insert($board);
        }
    }

    /**
     * 태그 리스트 정보
     *
     * @return array
     */
    public function getBoardTagList(): array
    {
        return [
            [
                'name' => 'About Me',
                'name_ko' => "나에 대해서",
                'use' => true
            ],
            [
                'name' => 'Blog',
                'name_ko' => "블로그",
                'use' => true
            ],
            [
                'name' => 'Etc',
                'name_ko' => "기타",
                'use' => true
            ],
            [
                'name' => 'Development',
                'name_ko' => "개발",
                'use' => true
            ],
            [
                'name' => 'Life',
                'name_ko' => "삶",
                'use' => true
            ],
            [
                'name' => 'Review',
                'name_ko' => "리뷰",
                'use' => true
            ],
            [
                'name' => 'Chat',
                'name_ko' => "잡담",
                'use' => true
            ]
        ];
    }
}
