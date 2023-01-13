<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\Managers\CheckManager;

class CheckIfAlertShouldBeSentAction implements ActionInterface
{
    private CheckManager $checkManager;

    public function __construct()
    {
        $this->checkManager = resolve(CheckManager::class);
    }

    public function execute(...$args): bool
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];
        $data = $args[1];

        return $this->checkManager->driver($alert->widget)->check($alert, $data);
    }
}
