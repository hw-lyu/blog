<?php

use App\Http\Controllers\BoardPostController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::resource('board/{boardName}/post', BoardPostController::class)
    ->parameters(['post' => 'postId']);

Route::group(['prefix' => 'admin/v1', 'as' => 'admin.v1.'], function () {
});
