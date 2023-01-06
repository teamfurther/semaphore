<?php

namespace Semaphore\Actions\Alerts;

use App\Models\User;
use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\Managers\AlertMessageManager;
use Semaphore\Notifications\AlertNotification;

class SendAlertNotificationAction implements ActionInterface
{
    private AlertMessageManager $alertMessageManager;

    public function __construct()
    {
        $this->alertMessageManager = resolve(AlertMessageManager::class);
    }

    public function execute(...$args): bool
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];
        $data = $args[1];
        $message = $this->alertMessageManager->driver($alert->widget)->getMessage($alert, $data);

        $user = new User();

        $user->notify(new AlertNotification($message));

        return true;
    }
}
