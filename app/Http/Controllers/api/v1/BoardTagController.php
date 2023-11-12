<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BoardTagList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BoardTagController extends Controller
{
    public function __construct(
        public BoardTagList $boardTagList,
        public int          $limit = 5
    )
    {
    }


    /**
     * 태그 리스트
     *
     * @return JsonResponse
     */
    public function index(int $tagId): JsonResponse
    {
        $tagList = $this
            ->boardTagList
            ->with([
                'post' => fn($query) => $query
                    ->where('use', true)
                    ->orderBy('id', 'desc')
                    ->limit($this->limit)
            ])
            ->where('use', true)
            ->findOrFail($tagId);

        return response()->json(['tagList' => $tagList, 'code' => Response::HTTP_OK]);
    }
}
