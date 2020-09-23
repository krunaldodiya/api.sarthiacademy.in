<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\MessageReceived;

use App\Chat;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $chat = Chat::create([
            'sender_id' => auth()->id(),
            'message'=> $request->message,
            'channel_id' => $request->channel_id
        ]);

        event(new MessageReceived($chat));

        return ['chat' => $chat];
    }

    public function getMessages(Request $request)
    {
        $messages = Chat::where(['channel_id' => $request->channel_id])->get();

        return ['messages' => $messages];
    }
}
