<?php

namespace Semaphore\Managers;

use Semaphore\Widgets\Widget;
use Semaphore\Widgets\Eol;
use Semaphore\Widgets\Gauge;
use Semaphore\Widgets\Trend;
use Semaphore\Widgets\Uptime;
use Semaphore\Widgets\Value;
use Exception;
use Illuminate\Support\Manager;

class WidgetManager extends Manager
{
    public function createEolDriver(): Widget
    {
        return resolve(Eol::class);
    }

    public function createGaugeDriver(): Widget
    {
        return resolve(Gauge::class);
    }

    public function createTrendDriver(): Widget
    {
        return resolve(Trend::class);
    }

    public function createUptimeDriver(): Widget
    {
        return resolve(Uptime::class);
    }

    public function createValueDriver(): Widget
    {
        return resolve(Value::class);
    }

    public function getDefaultDriver()
    {
        throw new Exception('Driver must be provided.', 400);
    }
}
