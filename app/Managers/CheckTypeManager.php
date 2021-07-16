<?php


namespace App\Managers;

use App\CheckTypes\CheckType;
use App\CheckTypes\Eol;
use App\CheckTypes\Gauge;
use App\CheckTypes\Trend;
use App\CheckTypes\Uptime;
use App\CheckTypes\Value;
use Exception;
use Illuminate\Support\Manager;

class CheckTypeManager extends Manager
{
    public function getEolDriver(): CheckType
    {
        return resolve(Eol::class);
    }

    public function getGaugeDriver(): CheckType
    {
        return resolve(Gauge::class);
    }

    public function getTrendDriver(): CheckType
    {
        return resolve(Trend::class);
    }

    public function getUptimeDriver(): CheckType
    {
        return resolve(Uptime::class);
    }

    public function getValueDriver(): CheckType
    {
        return resolve(Value::class);
    }

    public function getDefaultDriver()
    {
        throw new Exception('Driver must be provided.', 400);
    }
}