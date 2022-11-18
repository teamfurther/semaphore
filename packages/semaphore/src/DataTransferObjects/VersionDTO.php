<?php

namespace Semaphore\DataTransferObjects;

class VersionDTO
{
    public int $major;
    public int|null $minor;
    public int|null $patch;

    public function __construct(int $major, int $minor = null, int $patch = null)
    {
        $this->major = $major;
        $this->minor = $minor;
        $this->patch = $patch;
    }

    public function majorMinor(): string
    {
        return $this->major . '.' . $this->minor;
    }

    public function unspecifiedMinor(): string
    {
        return $this->major . '.x';
    }

    public function unspecifiedPatch(): string
    {
            return $this->major . '.' . $this->minor . '.x';
    }

    public function version(): string
    {
        return $this->major . '.' . $this->minor . '.' . $this->patch;
    }
}
