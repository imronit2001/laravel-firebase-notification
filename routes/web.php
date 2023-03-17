<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationHandler;

Route::get('/', function () {
    return view('welcome');
});


Route::patch('/fcm-token', [HomeController::class, 'updateToken'])->name('fcmToken');
Route::post('/device/notification/send', [NotificationHandler::class, 'sendNotification'])->name('notification');
Route::post('/device/token/get', [NotificationHandler::class, 'getDeviceToken']);
Route::post('/device/token/register', [NotificationHandler::class, 'registerDeviceToken']);
