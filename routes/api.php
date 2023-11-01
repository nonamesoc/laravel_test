<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintController;
use App\Http\Controllers\Api\PasteController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('paste', [PasteController::class, 'store']);
Route::get('paste/{paste_uri}', [PasteController::class, 'show']);
Route::get('recent-pastes', [PasteController::class, 'showRecentPastes']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('recent-user-pastes', [PasteController::class, 'showRecentUserPastes']);
    Route::get('user-pastes', [PasteController::class, 'showPastesForUser']);
    Route::post('paste/{paste_uri}/complaint', [ComplaintController::class, 'store']);
});
