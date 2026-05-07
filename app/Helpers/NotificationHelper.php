<?php
namespace App\Helpers;

use App\Models\Notification;

class NotificationHelper
{
    public static function send($userId, $title, $body, $type = 'general')
    {
        Notification::create([
            'user_id' => $userId,
            'title'   => $title,
            'body'    => $body,
            'type'    => $type,
        ]);
    }
}