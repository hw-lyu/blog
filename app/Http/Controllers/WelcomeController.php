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
        return Inertia::render('Welcome',);
    }
}
