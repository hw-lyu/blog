<?php

namespace App\Http\Controllers\Admin\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * 관리자를 구분하기 위한 API
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {

        if (!empty($request->session()->get('admin_email') === env('ADMIN_EMAIL'))) {
            return response()->json([
                'is_admin' => true
            ]);
        }

        return response()->json([
            'is_admin' => false
        ]);
    }
}
