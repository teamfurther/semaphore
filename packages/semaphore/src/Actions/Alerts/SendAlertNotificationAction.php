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
    private GetAlertIsSnoozedAction $getAlertIsSnoozedAction;
    private StoreAlertSentTimeInCacheAction $storeAlertSentTimeInCacheAction;

    public function __construct()
    {
        $this->alertMessageManager = resolve(AlertMessageManager::class);
        $this->getAlertIsSnoozedAction = resolve(GetAlertIsSnoozedAction::class);
        $this->storeAlertSentTimeInCacheAction = resolve(StoreAlertSentTimeInCacheAction::class);
    }

    public function execute(...$args): bool
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];
        $data = $args[1];
        $message = $this->alertMessageManager->driver($alert->widget)->getMessage($alert, $data);

        $user = new User();

        if (!$this->getAlertIsSnoozedAction->execute($alert)) {
            $user->notify(new AlertNotification($message));
            $this->storeAlertSentTimeInCacheAction->execute($alert);
        }

        return true;
    }
}
