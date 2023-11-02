<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PasteController;
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

Route::get('/', function () {
    return view('paste.create-paste');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])
        ->name('register');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::get('/login/google', [GoogleLoginController::class, 'redirect'])
        ->name('login.google');
    Route::get('/login/google/callback', [GoogleLoginController::class, 'callback'])
        ->name('login.google.callback');
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('user-pastes', [PasteController::class, 'showPastesForUser'])->name('user-pastes');

    Route::get('{paste_uri}/complaint', [ComplaintController::class, 'create'])->name('complaint');

    Route::post('{paste_uri}/complaint', [ComplaintController::class, 'store'])->name('complaint');
});

Route::post('create-paste', [PasteController::class, 'store'])->name('create-paste');

Route::get('{paste_uri}', [PasteController::class, 'show'])->name('show-paste');
