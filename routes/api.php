<?php

use App\Http\Controllers\Backend\Api\v1\AboutController;
use App\Http\Controllers\Backend\Api\v1\PostController;
use App\Http\Controllers\Backend\Api\v1\TagController;
use App\Http\Controllers\Backend\Api\v1\UserController;
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

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    Route::resource('posts', PostController::class)->except('create', 'edit');
    Route::resource('tags', TagController::class)->except('create', 'edit');
    Route::resource('abouts', AboutController::class)->only('index', 'store');

});


Route::post('v1/login', [UserController::class, 'login'])->name('login');
