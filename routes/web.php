<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
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
Route::post('/pusher/auth', [AuthController::class, 'authPusher'])
    ->middleware('auth');

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'loginView')->name('login');
    Route::post('make-login', 'login')->name('make_login');

    Route::get('register', 'registerView')->name('register');
    Route::post('make-register', 'register')->name('make_register');
});

Route::middleware(['auth:web'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(ChatController::class)->group(function () {
        Route::get('/', 'index')->name('chat');
        Route::post('send-private', 'send')->name('send_private');
        Route::get('chat-messages/{chat_user_id}', 'getChatMessages')->name('chat_messages');
    });
});

// Route::get('/websocket', [ChatController::class, 'websocket'])->name('websocket');
