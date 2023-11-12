<?php

use App\Http\Controllers\Admin\V1\MemberController;
use App\Http\Controllers\Admin\V1\MembersLoginController;
use App\Http\Controllers\Api\V1\BoardController;
use App\Http\Controllers\Api\V1\BoardPostController;
use App\Http\Controllers\Api\V1\BoardTagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "Api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin/v1', 'as' => 'api.admin.v1.'], function () {
    Route::get('members', [MembersLoginController::class, 'index'])
        ->name('members');
    // 임시적으로 세션 사용 - 관리자용 아이디 여러개를 쓰지 않으므로 우선 응답시 세션을 받아 관리자 아이디 처리함
    Route::get('member', [MemberController::class, 'index'])
        ->name('member')->middleware(['web']);
    Route::get('members/oauth2', [MembersLoginController::class, 'oauth2callback'])
        ->name('members.oauth2')
        ->middleware(['web']);
});

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::get('board', [BoardController::class, 'index'])
        ->name('board');

    Route::get('board/tag/{tagId}', [BoardTagController::class, 'index'])
        ->name('board.tag');

    Route::resource('board/{boardName}/post', BoardPostController::class)
        ->parameters(['post' => 'postId']);
});



