<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;

class ProcessAlertsAction implements ActionInterface
{
    /** @var array <string> */
    private array $alerts;
    private CheckIfAlertShouldBeSentAction $checkIfAlertShouldBeSent;
    private GetAlertsAction $getAlertsAction;
    private SendAlertNotificationAction $sendAlertNotificationAction;

    public function __construct()
    {
        $this->checkIfAlertShouldBeSent = resolve(CheckIfAlertShouldBeSentAction::class);
        $this->getAlertsAction = resolve(GetAlertsAction::class);
        $this->sendAlertNotificationAction = resolve(SendAlertNotificationAction::class);
    }

    public function execute(...$args): void
    {
        $this->alerts = $this->getAlertsAction->execute();

        foreach ($this->alerts as $alert) {
            if ($this->checkIfAlertShouldBeSent->execute($alert)) {
                $this->sendAlertNotificationAction->execute($alert);
            }
        }
    }
}