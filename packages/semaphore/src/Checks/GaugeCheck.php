<?php

namespace Semaphore\Checks;

use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\DataTransferObjects\GaugeDTO;

class GaugeCheck implements CheckInterface
{
    /**
     * @param GaugeDTO[] $widget
     */
    public function check(AlertDTO $alert, $widget): bool
    {
        foreach ($widget as $item) {
            if ($item->value >= $alert->max) {
                return true;
            }
        }

        return false;
    }
}
