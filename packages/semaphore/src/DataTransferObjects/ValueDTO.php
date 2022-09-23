<?php

namespace Semaphore\DataTransferObjects;

class ValueDTO
{
    public string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }
}
