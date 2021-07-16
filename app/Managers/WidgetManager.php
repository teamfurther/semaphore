<?php


namespace App\Managers;

use App\Widgets\Widget;
use App\Widgets\Eol;
use App\Widgets\Gauge;
use App\Widgets\Trend;
use App\Widgets\Uptime;
use App\Widgets\Value;
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
