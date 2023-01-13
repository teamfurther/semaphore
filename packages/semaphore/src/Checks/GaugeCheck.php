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
        return $widget[0]->value >= $alert->max;
    }
}
