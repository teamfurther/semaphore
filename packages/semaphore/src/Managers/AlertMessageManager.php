<?php

namespace Semaphore\Managers;

use Exception;
use Illuminate\Support\Manager;
use Semaphore\AlertMessages\AlertMessageInterface;
use Semaphore\AlertMessages\EolAlertMessage;
use Semaphore\AlertMessages\GaugeAlertMessage;
use Semaphore\AlertMessages\TrendAlertMessage;
use Semaphore\AlertMessages\UptimeAlertMessage;
use Semaphore\AlertMessages\ValueAlertMessage;

class AlertMessageManager extends Manager
{
    public function createEolDriver(): AlertMessageInterface
    {
        return resolve(EolAlertMessage::class);
    }

    public function createGaugeDriver(): AlertMessageInterface
    {
        return resolve(GaugeAlertMessage::class);
    }

    public function createTrendDriver(): AlertMessageInterface
    {
        return resolve(TrendAlertMessage::class);
    }

    public function createUptimeDriver(): AlertMessageInterface
    {
        return resolve(UptimeAlertMessage::class);
    }

    public function createValueDriver(): AlertMessageInterface
    {
        return resolve(ValueAlertMessage::class);
    }

    public function getDefaultDriver()
    {
        throw new Exception('Driver must be provided.', 400);
    }
}
