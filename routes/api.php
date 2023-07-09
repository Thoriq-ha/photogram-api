<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/auth/user', function(Request $request){
        return auth()->user();
    });

    Route::apiResource('/user',UserController::class);
    Route::apiResource('/post',PostController::class);

    Route::prefix('/post/{post}')->group(function (){
        Route::apiResource('comment',CommentController::class)->only(['index','store','destroy']);
    });

    Route::apiResource('/tag', TagController::class)->only(['index','show','store']);

});
Route::post('/login', [AuthController::class, 'login'])->name('login');
