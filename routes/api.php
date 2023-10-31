<?php

use App\Http\Controllers\admin\v1\MembersController;
use App\Http\Controllers\api\v1\BoardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin/v1', 'as' => 'api.admin.v1.'], function () {
    Route::get('members', [MembersController::class, 'index']);
    Route::get('members/oauth2', [MembersController::class, 'oauth2callback']);
});

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::get('board', [BoardController::class, 'index'])->name('board');
});



