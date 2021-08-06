<?php

namespace Semaphore\Actions\Notification;

use App\Models\User;
use Semaphore\Notifications\SendNotification;

class SendNotificationAction
{
    public function execute()
    {
        $user = new User();

        $user->notify(new SendNotification($user));

        return ['Message sent'];
    }
}
