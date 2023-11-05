<?php

namespace App\Http\Controllers\admin\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class MemberController extends Controller
{
    /**
     * 관리자를 구분하기 위한 API
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
    {
        session_start();

        if (!empty($_SESSION['admin_email']) && $_SESSION['admin_email'] === env('ADMIN_EMAIL')) {
            return response()->json([
                'is_admin' => true
            ]);
        }

        return response()->json([
            'is_admin' => false
        ]);
    }
}
