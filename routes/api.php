<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MultiLanguageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user-phone', [UserController::class, 'getPhone'])->name('user-phone');
Route::get('/user-post', [UserController::class, 'getPost'])->name('user-post');
Route::get('/user-role', [UserController::class, 'getRoles'])->name('user-role');
Route::get('/phone-user', [PhoneController::class, 'getUser'])->name('phone-user');
Route::get('/post-comment', [PostController::class, 'getComments'])->name('post-comment');
Route::get('/comment-post', [CommentController::class, 'getPost'])->name('comment-post');

Route::resource('posts', PostController::class);

Route::get('test-email', [JobController::class, 'processQueue']);

Route::get('/multi-language', [MultiLanguageController::class, 'index'])
      ->middleware('language');