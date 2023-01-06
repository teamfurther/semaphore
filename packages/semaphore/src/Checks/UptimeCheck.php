<?php

namespace Semaphore\Checks;

use Semaphore\DataTransferObjects\AlertDTO;

class UptimeCheck implements CheckInterface
{
    public function check(AlertDTO $alert, $widget): bool
    {
        return false;
    }
}
