<?php

namespace Semaphore\DataTransferObjects;

class TrendDTO
{
    public int $pid;
    public string $processName;
    /** @var ValueTimeDTO[] $values */
    public array $values;

    public function __construct(int $pid, string $processName, array $values)
    {
        $this->pid = $pid;
        $this->processName = $processName;
        $this->values = $values;
    }
}
