<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BoardPostController extends Controller
{

    /**
     * 리스트
     *
     * @return InertiaResponse
     */
    public function index() : InertiaResponse
    {
        // 전역 세션 추가
        session_start();

        return Inertia::render('Welcome');
    }

    /**
     * 글 보기
     *
     * @param int $postId
     * @return InertiaResponse
     */
    public function show(string $boardName, int $postId): InertiaResponse
    {
        return Inertia::render('Component/Detail', [
            'board_name' => $boardName,
            'post_id' => $postId
        ]);
    }
}
