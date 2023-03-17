<?php

namespace App\Http\Controllers;

use App\Models\TipDevice;
use Illuminate\Http\Request;

use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Notification;

class NotificationHandler extends Controller
{

    public static function sendNotification(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $devicetoken = $request->input('fcmtoken');
        if ($devicetoken != false) {
            // echo json_encode(array('status' => 'success', 'result' => $result));
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, '{"to": "' . $devicetoken . '","notification": {"title": "' . $title . '","body":"' . $body . '","mutable_content": true,"sound": "Tri-tone"},"priority":"high"}');

            $headers = array();
            $headers[] = 'Authorization: key=AAAALg_Cu_w:APA91bEBddAmUIw1Ov-3fLKU8vNmxB1IRKCv14jwYA9OdSjq09amX7tka2BZdysKkO_iY_TATx5xbFzwRp8bv9jht8PxbsThMncJA9fIXLTQHaAtn-zitMS8XNYNO7NNe0v0D4usIV1Z';
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'Cache-Control: no-cache';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);
            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'message' => 'Notification Send'
            ]);
        } else {
            return response()->json([
                'status' => 'failure',
                'status_code' => 500
            ]);
        }
    }

    public static function registerDeviceToken(Request $request)
    {
        $obj = TipDevice::where('userid', $request->input('userid'))->first();
        if ($obj) {
            $obj->usertype = $request->input('usertype');
            $obj->fcmtoken = $request->input('fcmtoken');
            $obj->save();
        } else {
            $obj = new TipDevice();
            $obj->userid = $request->input('userid');
            $obj->usertype = $request->input('usertype');
            $obj->fcmtoken = $request->input('fcmtoken');
            $obj->save();
        }

        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => 'Device Token Registered'
        ]);
    }
    public static function getDeviceToken(Request $request)
    {

        $obj = TipDevice::where('userid', $request->input('userid'))->first();
        if ($obj) {
            return response()->json([
                'status' => 'success',
                'status_code' => 200,
                'fcmtoken' => $obj->fcmtoken
            ]);
        } else {
            return response()->json([
                'status' => 'failure',
                'status_code' => 500
            ]);
        }
    }
}
