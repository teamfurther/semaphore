<?php

namespace App\Actions\Alerts;

use App\Actions\ActionInterface;
use Illuminate\Cache\CacheManager;

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