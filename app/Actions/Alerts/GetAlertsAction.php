<?php

namespace App\Actions\Alerts;

use App\Actions\ActionInterface;

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