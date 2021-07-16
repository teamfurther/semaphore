<?php

namespace App\DataTransferObjects;

class ValueTimeDTO
{
    public float $time;
    public string $value;

    public function __construct(float $time, string $value)
    {
        $this->time = $time;
        $this->value = $value;
    }
}
