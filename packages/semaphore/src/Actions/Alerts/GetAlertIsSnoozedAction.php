<?php

namespace Semaphore\Actions\Alerts;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;

class GetAlertIsSnoozedAction implements ActionInterface
{
    private GenerateAlertCacheKeyAction $generateAlertCacheKeyAction;

    public function __construct()
    {
        $this->generateAlertCacheKeyAction = resolve(GenerateAlertCacheKeyAction::class);
    }

    public function execute(...$args): bool
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];

        $time = Cache::get($this->generateAlertCacheKeyAction->execute($alert));

        if (!$time) {
            return false;
        }

        return Carbon::parse($time)->addSeconds($alert->snooze)->timestamp >= Carbon::now()->timestamp;
    }
}
