<?php

namespace Semaphore\DataTransferObjects;

class TrendValueDTO
{
    public int $pid;
    public string $processName;
    public string $value;

    public function __construct(int $pid, string $processName, string $value)
    {
        $this->pid = $pid;
        $this->processName = $processName;
        $this->value = $value;
    }
}
