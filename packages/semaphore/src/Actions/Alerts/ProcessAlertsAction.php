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
    private GetPrometheusDataForAlertAction $getPrometheusDataForAlertAction;

    public function __construct()
    {
        $this->checkIfAlertShouldBeSent = resolve(CheckIfAlertShouldBeSentAction::class);
        $this->getAlertsAction = resolve(GetAlertsAction::class);
        $this->sendAlertNotificationAction = resolve(SendAlertNotificationAction::class);
        $this->getPrometheusDataForAlertAction = resolve(GetPrometheusDataForAlertAction::class);
    }

    public function execute(...$args): void
    {
        $this->alerts = $this->getAlertsAction->execute();

        foreach ($this->alerts as $alert) {
            $data = $this->getPrometheusDataForAlertAction->execute($alert);

            if ($this->checkIfAlertShouldBeSent->execute($alert, $data)) {
                $this->sendAlertNotificationAction->execute($alert, $data);
            }
        }
    }
}
