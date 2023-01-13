<?php

namespace Semaphore\AlertMessages;

use Carbon\Carbon;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\DataTransferObjects\GaugeDTO;

class GaugeAlertMessage implements AlertMessageInterface
{
    /**
     * @param GaugeDTO[] $data
     */
    public function getMessage(AlertDTO $alert, $data): string
    {
        $max = $alert->max;

        foreach ($data as $item) {
            if ($item->value >= $max) {
                return sprintf(
                    __('semaphore::alerts.current.gt'),
                    $alert->instance,
                    $alert->name . ':' . $alert->filter,
                    $item->value * 100 . '%',
                    $max * 100 . '%',
                    Carbon::now()->addSeconds($alert->period + 1)->diffForHumans(null, true),
                );
            }
        }

        return  '';
    }
}
