<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;
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

// Author (Other routes).
Route::prefix('author')->group(function () {
    Route::controller(AuthorController::class)->group(function () {
    });
});

// Author (CRUD routes).
Route::resource('author', AuthorController::class);

// Publisher (Other routes).
Route::prefix('publisher')->group(function () {
    Route::controller(PublisherController::class)->group(function () {
    });
});

// Publisher (CRUD routes).
Route::resource('publisher', PublisherController::class);
