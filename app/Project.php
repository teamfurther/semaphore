<?php

namespace App;

use Exception;

class Project
{
    private array $frequency;
    private string $name;
    private Ssh $ssh;
    private string $url;

    public function __construct(
        array $frequency,
        string $name,
        Ssh $ssh,
        string $url
    ) {
        $this->frequency = $frequency;
        $this->name = $name;
        $this->ssh = $ssh;
        $this->url = $url;
    }

    public function frequency(string $key): array
    {
        if (!array_key_exists($key, $this->frequency)) {
            throw new Exception($key . ' not found.', 404);
        }

        return $this->frequency[$key];
    }

    public function name(): string
    {
        return $this->name;
    }

    public function ssh(): Ssh
    {
        return $this->ssh;
    }

    public function url(): string
    {
        return $this->url;
    }
}
