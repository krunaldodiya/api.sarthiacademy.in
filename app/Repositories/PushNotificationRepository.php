<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Http;

class PushNotificationRepository implements PushNotificationRepositoryInterface
{
    public function client()
    {
        return Http::withHeaders([
            'Authorization' => env('PUSH_TOKEN'),
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ]);
    }

    public function subscribeTopic($topic, $tokens)
    {
        try {
            $response = $this->client()->post("https://iid.googleapis.com/iid/v1:batchAdd", [
                "to" => "/topics/{$topic}",
                "registration_tokens" => $tokens,
            ]);

            return $response->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function notify($topic, $data)
    {
        try {
            $response = $this->client()->post("https://fcm.googleapis.com/fcm/send", [
                'to' => $topic,
                'notification' => $data,
                'data' => $data,
            ]);

            return $response->json();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
