<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;

class GetAlertsAction implements ActionInterface
{
    public function __construct()
    {
    }

    public function execute(...$args): array
    {
        $config = config('semaphore_projects');

        dd($config);
    }
}