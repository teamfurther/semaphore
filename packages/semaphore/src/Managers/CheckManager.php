<?php

namespace Semaphore\Managers;

use Exception;
use Illuminate\Support\Manager;
use Semaphore\Checks\CheckInterface;
use Semaphore\Checks\EolCheck;
use Semaphore\Checks\GaugeCheck;
use Semaphore\Checks\TrendCheck;
use Semaphore\Checks\UptimeCheck;
use Semaphore\Checks\ValueCheck;

class CheckManager extends Manager
{
    public function createEolDriver(): CheckInterface
    {
        return resolve(EolCheck::class);
    }

    public function createGaugeDriver(): CheckInterface
    {
        return resolve(GaugeCheck::class);
    }

    public function createTrendDriver(): CheckInterface
    {
        return resolve(TrendCheck::class);
    }

    public function createUptimeDriver(): CheckInterface
    {
        return resolve(UptimeCheck::class);
    }

    public function createValueDriver(): CheckInterface
    {
        return resolve(ValueCheck::class);
    }

    public function getDefaultDriver()
    {
        throw new Exception('Driver must be provided.', 400);
    }
}
