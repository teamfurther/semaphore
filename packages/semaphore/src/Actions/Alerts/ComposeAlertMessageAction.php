<?php

namespace Semaphore\Actions\Alerts;

use Carbon\Carbon;
use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;

class ComposeAlertMessageAction implements ActionInterface
{
    public function execute(...$args): string
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];

        $period = $alert->period !== 0 ? 'period' : 'current';
        $comparison = $alert->min > 0
            ? $alert->max < 1
                ? 'interval'
                : 'lt'
            : 'gt';

        return sprintf(
            __('semaphore::alerts.' . $period . '.' . $comparison),
            $alert->instance,
            $alert->name,
            10,
            $alert->min * 100,
            $alert->max * 100,
            Carbon::now()->addSeconds($alert->period + 1)->diffForHumans(null, true),
        );
    }
}
