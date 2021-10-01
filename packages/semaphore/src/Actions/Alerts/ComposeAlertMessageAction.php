<?php

namespace Semaphore\Actions\Alerts;

use Carbon\Carbon;
use Semaphore\Actions\ActionInterface;

class ComposeAlertMessageAction implements ActionInterface
{
    /** @var array <string> */
    private array $alert;
    private string $message = '';

    public function execute(...$args): string
    {
        $this->alert = $args[0];

        $period = $this->alert['period'] !== 0 ? 'period' : 'current';
        $comparison = $this->alert['min'] > 0
            ? $this->alert['max'] < 1
                ? 'interval'
                : 'lt'
            : 'gt';

        $this->message = sprintf(
            __('semaphore::alerts.' . $period . '.' . $comparison),
            $this->alert['instance'],
            $this->alert['name'],
            10,
            $this->alert['min'] * 100,
            $this->alert['max'] * 100,
            Carbon::now()->addSeconds($this->alert['period'] + 1)->diffForHumans(null, true),
        );

        return $this->message;
    }
}