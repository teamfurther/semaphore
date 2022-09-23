<?php

namespace Semaphore\DataTransferObjects;

class TrendDTO
{

    public int $time;
    public float $total;
    /** @var TrendValueDTO[] $values */
    public array $values;

    public function __construct(int $time, float $total, array $values)
    {
        $this->time = $time;
        $this->total = $total;
        $this->values = $values;
    }
}
