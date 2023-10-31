<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class WelcomeController extends Controller
{
    /**
     * 메인
     *
     * @return Response
     */
    public function index() : Response {
        // 전역 세션 추가
        session_start();

        return Inertia::render('Welcome',);
    }
}
