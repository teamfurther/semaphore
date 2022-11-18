<?php

namespace Semaphore\DataTransferObjects;

class AlertDTO
{
    public string $instance;
    public string $id;
    public string $metric;
    public string $name;
    public string $channel;
    public ?string $filter;
    public float $max;
    public float $min;
    public int $period;

    public function __construct(
        string $instance,
        string $id,
        string $metric,
        string $name,
        string $channel,
        ?string $filter,
        float $max,
        float $min,
        int $period
    ) {
        $this->instance = $instance;
        $this->id = $id;
        $this->metric = $metric;
        $this->name = $name;
        $this->channel = $channel;
        $this->filter = $filter;
        $this->max = $max;
        $this->min = $min;
        $this->period = $period;
    }
}
