<?php

namespace Semaphore\AlertMessages;

use Semaphore\DataTransferObjects\AlertDTO;

interface AlertMessageInterface
{
    public function getMessage(AlertDTO $alert, $data): string;
}
