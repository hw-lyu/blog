<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Board;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class BoardController extends Controller
{
    public function __construct(
        public Board $board
    )
    {
    }

    /**
     * 게시판 리스트
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        /**
         * select * from `board` where `use` = 1
         * order by `parent_id` asc, `depth` asc, `order` asc
         */

        $data = $this->board::where('use', true)
            ->orderBy('parent_id', 'asc')
            ->orderBy('depth', 'asc')
            ->orderBy('order', 'asc')
            ->get();

        $data->makeHidden(['created_at', 'updated_at', 'deleted_at', 'use']);

        $dataArr = $data->toArray();

        // 메뉴 parent_id 기준으로 재가공
        $menu = [];
        for ($i = 0; $i < count($dataArr); $i++) {
            for ($o = 0; $o < count($dataArr); $o++) {
                if ($dataArr[$i]['parent_id'] !== $dataArr[$o]['parent_id']) continue;

                // id와 parent_id가 같은 경우에만 재가공
                if ($dataArr[$i]['id'] === $dataArr[$o]['parent_id']) {
                    $menu[($dataArr[$i]['parent_id']) - 1][] = ['name_en' => Str::slug($dataArr[$o]['name'], '-'), ...$dataArr[$o]];
                }
            }
        }

        return response()->json(['data' => $menu, 'code' => Response::HTTP_OK]);
    }
}
