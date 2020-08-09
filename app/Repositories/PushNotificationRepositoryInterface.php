<?php

namespace App\Repositories;

interface PushNotificationRepositoryInterface
{
    public function notify($topic, $data);
    public function subscribeTopic($topic, $tokens);
}
