<?php

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


Route::apiResource('place', App\Http\Controllers\PlaceController::class);

Route::apiResource('category', App\Http\Controllers\CategoryController::class);

Route::apiResource('feature', App\Http\Controllers\FeatureController::class);

Route::apiResource('tag', App\Http\Controllers\TagController::class);

Route::apiResource('review', App\Http\Controllers\ReviewController::class);

Route::apiResource('reservation', App\Http\Controllers\ReservationController::class);

Route::apiResource('image', App\Http\Controllers\ImageController::class);

Route::apiResource('favorite', App\Http\Controllers\FavoriteController::class);

Route::apiResource('phone', App\Http\Controllers\PhoneController::class);

Route::apiResource('post', App\Http\Controllers\PostController::class);

Route::apiResource('contact', App\Http\Controllers\ContactController::class);
