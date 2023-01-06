<?php

namespace Semaphore\AlertMessages;

use Semaphore\DataTransferObjects\AlertDTO;

class GaugeAlertMessage implements AlertMessageInterface
{
    public function getMessage(AlertDTO $alert, $data): string
    {
        return '';
    }
}
