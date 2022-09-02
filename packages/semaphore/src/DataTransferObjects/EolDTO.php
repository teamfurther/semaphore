<?php

namespace Semaphore\DataTransferObjects;

class EolDTO
{
    public string $product;
    public VersionDTO $version;
    public VersionDTO $latest;
    public bool $activeSupport;
    public bool $securitySupport;

    public function __construct(
        string $product,
        VersionDTO $version,
        VersionDTO $latest,
        bool $activeSupport,
        bool $securitySupport,
    )
    {
        $this->product = $product;
        $this->version = $version;
        $this->latest = $latest;
        $this->activeSupport = $activeSupport;
        $this->securitySupport = $securitySupport;
    }
}
