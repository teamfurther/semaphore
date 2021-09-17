<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;

class CheckIfAlertShouldBeSentAction implements ActionInterface
{

    public function __construct()
    {
        //
    }

    public function execute(...$args): bool
    {
        return 1;
    }
}