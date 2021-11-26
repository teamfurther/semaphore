<?php

namespace Semaphore\DataTransferObjects;

class GaugeDTO
{
    public string $name;
    public float $value;

    public function __construct(string $name, float $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
