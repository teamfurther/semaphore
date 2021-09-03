<?php

namespace Semaphore\Http\Controllers\Api;

use Semaphore\Actions\Notification\SendNotificationAction;

class NotificationController
{
    private SendNotificationAction $sendNotificationAction;

    public function __construct
    (
        SendNotificationAction $sendNotificationAction
    )
    {
        $this->sendNotificationAction = $sendNotificationAction;
    }

    public function notify()
    {
        return response()->json($this->sendNotificationAction->execute());
    }
}
