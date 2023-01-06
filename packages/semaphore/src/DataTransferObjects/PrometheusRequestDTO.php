<?php

namespace Semaphore\DataTransferObjects;

class PrometheusRequestDTO
{
    public ?string $end;
    public string $instance;
    public string $metric;
    public ?string $start;

    public function __construct(?string $end, string $instance, string $metric, ?string $start)
    {
        $this->end = $end;
        $this->instance = $instance;
        $this->metric = $metric;
        $this->start = $start;
    }
}
