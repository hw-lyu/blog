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
        return Inertia::render('Welcome',);
    }
}
