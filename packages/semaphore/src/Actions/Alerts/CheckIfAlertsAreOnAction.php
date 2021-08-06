<?php

namespace Semaphore\Actions\Alerts;

use Illuminate\Cache\CacheManager;
use Semaphore\Actions\ActionInterface;

class CheckIfAlertsAreOnAction implements ActionInterface
{
    private CacheManager $cache;

    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public function execute(...$args): bool
    {
        return !$this->cache->has('alerts_on') || $this->cache->get('alerts_on') === 1;
    }
}