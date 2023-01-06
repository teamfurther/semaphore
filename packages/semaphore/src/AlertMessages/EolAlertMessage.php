<?php

namespace Semaphore\AlertMessages;

use Semaphore\DataTransferObjects\AlertDTO;

class EolAlertMessage implements AlertMessageInterface
{
    public function getMessage(AlertDTO $alert, $data): string
    {
        return '';
    }
}
