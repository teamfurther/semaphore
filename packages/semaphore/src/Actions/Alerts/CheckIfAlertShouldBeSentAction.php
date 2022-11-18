<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;

class CheckIfAlertShouldBeSentAction implements ActionInterface
{
    public function __construct()
    {
        //
    }

    public function execute(...$args): bool
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];

        return 1;
    }
}
