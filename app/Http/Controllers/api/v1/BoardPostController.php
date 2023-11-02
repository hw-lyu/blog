<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\BoardPost;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class BoardPostController extends Controller
{
    public function __construct(
        protected BoardPost $boardPost,
        public int          $limit = 5,
    )
    {
    }

    /**
     * 게시물 포스트 리스트
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $post = $this
            ->boardPost
            ->where('use', true)
            ->orderBy('id', 'desc')
            ->paginate($this->limit);

        return response()->json(['post' => $post, 'code' => Response::HTTP_OK]);
    }

    /**
     * 게시물 보기
     *
     * @param int $postId
     * @return JsonResponse
     */
    public function show(int $postId) : JsonResponse
    {
        $post = $this
            ->boardPost
            ->where('use', true)
            ->findOrFail($postId);

        return response()->json(['post' => $post, 'code' => Response::HTTP_OK]);
    }
}
