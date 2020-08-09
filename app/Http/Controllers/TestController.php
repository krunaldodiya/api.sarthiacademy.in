<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notification;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function client()
    {
        return Http::withHeaders([
            'Authorization' => env('PUSH_TOKEN'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);
    }

    public function testUsers(Request $request)
    {
        return response(["users" => $this->users()], 200);
    }

    public function testAuth(Request $request)
    {
        return response(["token" => "mytoken", "user" => $this->users()[0]], 200);
    }

    public function testNotification(Request $request)
    {
        $notification = Notification::first();

        dd(asset("storage/{$notification['image']}"));
    }
}
