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
