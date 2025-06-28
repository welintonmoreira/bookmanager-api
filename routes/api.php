<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookAuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookPublisherController;
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

// Author (Other routes)
Route::prefix('author')->group(function () {
    Route::controller(AuthorController::class)->group(function () {
    });
});

// Author (CRUD routes).
Route::apiResource('author', AuthorController::class);

// Publisher (Other routes).
Route::prefix('publisher')->group(function () {
    Route::controller(PublisherController::class)->group(function () {
    });
});

// Publisher (CRUD routes).
Route::apiResource('publisher', PublisherController::class);

// Book (Other routes).
Route::prefix('book')->group(function () {
    Route::controller(BookController::class)->group(function () {
    });
});

// Book (CRUD routes).
Route::apiResource('book', BookController::class);

// Books Publishers (Other routes).
Route::prefix('book-publisher')->group(function () {
    Route::controller(BookPublisherController::class)->group(function () {
    });
});

// Books Publishers (CRUD routes).
Route::apiResource('book-publisher', BookPublisherController::class)
    ->except(['show', 'update']);

// Books Authors (Other routes).
Route::prefix('book-author')->group(function () {
    Route::controller(BookAuthorController::class)->group(function () {
    });
});

// Books Authors (CRUD routes).
Route::apiResource('book-author', BookAuthorController::class)
    ->except(['show', 'update']);
