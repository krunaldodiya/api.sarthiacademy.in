<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();

        return response(['notifications' => $notifications], 200);
    }

    public function markAsRead(Request $request)
    {
        $notifications = Notification::where('id', $request->notification_id)->update(['read' => true]);

        return response(['status' => true], 200);
    }
}
