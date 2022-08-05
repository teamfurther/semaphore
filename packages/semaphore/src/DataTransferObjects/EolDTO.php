<?php

namespace Semaphore\DataTransferObjects;

class EolDTO
{
    public string $name;
    public string $version;
    public string $color;

    public function __construct(string $name, string $version, string $color)
    {
        $this->name = $name;
        $this->version = $version;
        $this->color = $color;
    }
}
