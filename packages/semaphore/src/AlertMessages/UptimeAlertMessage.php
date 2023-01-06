<?php

namespace Semaphore\AlertMessages;

use Semaphore\DataTransferObjects\AlertDTO;

class UptimeAlertMessage implements AlertMessageInterface
{
    public function getMessage(AlertDTO $alert, $data): string
    {
        return '';
    }
}
