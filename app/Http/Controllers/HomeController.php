<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\SendPushNotification;
use Exception;
use Illuminate\Support\Facades\Notification as FacadesNotification;

class HomeController extends Controller
{
    public function updateToken(Request $request)
    {
        try {
            $request->user()->update(['fcm_token' => $request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success' => false
            ], 500);
        }
    }

    public function notification(Request $request)
    {
        try {
            $title = "New Task";
            $message = "You have a new task";
            $fcmTokens = "1468961532";

            // Notification::send(null, new SendPushNotification($title, $message, $fcmTokens));
            FacadesNotification::send(null, new SendPushNotification($title, $message, $fcmTokens));

            return response()->json([
                'status' => 200
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'error' => $e
            ]);
        }
    }
}
