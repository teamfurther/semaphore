<?php

namespace Semaphore\Actions\Alerts;

use App\Models\User;
use Semaphore\Actions\ActionInterface;
use Semaphore\Notifications\AlertNotification;

class SendAlertNotificationAction implements ActionInterface
{
    private ComposeAlertMessageAction $composeAlertMessageAction;

    public function __construct()
    {
        $this->composeAlertMessageAction = resolve(ComposeAlertMessageAction::class);
    }

    public function execute(...$args): bool
    {
        $alert = $args[0];
        $message = $this->composeAlertMessageAction->execute($alert);

        $user = new User();

        $user->notify(new AlertNotification($message));

        return true;
    }
}
