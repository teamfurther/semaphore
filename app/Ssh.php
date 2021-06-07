<?php

namespace App;

class Ssh
{
    private string $host;
    private string $key;
    private int $port;
    private string $user;

    public function __construct(
        string $host,
        string $key,
        int $port,
        string $user
    ) {
        $this->host = $host;
        $this->key = $key;
        $this->port = $port;
        $this->user = $user;
    }

    public function host(): string
    {
        return $this->host;
    }

    public function key(): string
    {
        return $this->key;
    }

    public function port(): int
    {
        return $this->port;
    }

    public function user(): string
    {
        return $this->user;
    }
}
