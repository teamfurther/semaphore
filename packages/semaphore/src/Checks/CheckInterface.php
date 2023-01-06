<?php

namespace Semaphore\Checks;

use Semaphore\DataTransferObjects\AlertDTO;

interface CheckInterface
{
    public function check(AlertDTO $alert, $widget): bool;
}
