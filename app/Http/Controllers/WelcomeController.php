<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class WelcomeController extends Controller
{
    /**
     * 메인
     *
     * @return InertiaResponse
     */
    public function index() : InertiaResponse {
        // 전역 세션 추가
        session_start();

        return Inertia::render('Welcome',);
    }
}
