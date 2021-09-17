<?php

namespace Semaphore\Actions\Notification;

use App\Models\User;
use Semaphore\Actions\ActionInterface;
use Semaphore\Notifications\SendNotification;

class SendAlertNotificationAction implements ActionInterface
{
    public function execute(...$args): bool
    {
        $user = new User();

        $user->notify(new SendNotification($user));

        return true;
    }
}
