<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class BoardPostController extends Controller
{

    /**
     * 메인 페이지
     *
     * @param string $boardName
     * @return InertiaResponse
     */
    public function index(string $boardName): InertiaResponse
    {
        return Inertia::render('Welcome', [
            'board_name' => $boardName
        ]);
    }

    /**
     * 글보기
     *
     * @param string $boardName
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

    public function create(string $boardName) {
        return Inertia::render('Component/Create');
    }

    /**
     * 글 수정
     *
     * @param string $boardName
     * @param int $postId
     * @return InertiaResponse
     */
    public function edit(string $boardName, int $postId): InertiaResponse
    {
        return Inertia::render('Component/Edit', [
            'board_name' => $boardName,
            'post_id' => $postId
        ]);
    }
}
