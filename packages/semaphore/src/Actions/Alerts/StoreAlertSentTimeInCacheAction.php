<?php

namespace Semaphore\Actions\Alerts;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\AlertDTO;

class StoreAlertSentTimeInCacheAction implements ActionInterface
{
    private GenerateAlertCacheKeyAction $generateAlertCacheKeyAction;

    public function __construct()
    {
        $this->generateAlertCacheKeyAction = resolve(GenerateAlertCacheKeyAction::class);
    }

    public function execute(...$args)
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];
        $key = $this->generateAlertCacheKeyAction->execute($alert);

        Cache::forget($key);
        Cache::put($key, Carbon::now()->timestamp);
    }
}
