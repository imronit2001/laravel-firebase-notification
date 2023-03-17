<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});


Route::patch('/fcm-token', [HomeController::class, 'updateToken'])->name('fcmToken');
Route::get('/send-notification', [HomeController::class, 'notification'])->name('notification');
