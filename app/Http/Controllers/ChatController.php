<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\MessageReceived;

use App\Chat;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $create = Chat::create([
            'sender_id' => auth()->id(),
            'message'=> $request->message,
            'channel_id' => $request->channel_id
        ]);

        $message = Chat::with('sender')->find($create->id);

        event(new MessageReceived($message));

        return ['message' => $message];
    }

    public function getMessages(Request $request)
    {
        $messages = Chat::with('sender')->where(['channel_id' => $request->channel_id])->get();

        return ['messages' => $messages];
    }
}
