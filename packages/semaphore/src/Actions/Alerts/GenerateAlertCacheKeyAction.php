<?php

namespace Semaphore\Actions\Alerts;

use Illuminate\Support\Str;
use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;

class GenerateAlertCacheKeyAction implements ActionInterface
{
    public function execute(...$args): string
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];

        return Str::slug($alert->instance . $alert->name . $alert->filter);
    }
}
