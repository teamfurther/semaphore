<?php

namespace Semaphore\Managers;

use Exception;
use Illuminate\Support\Manager;
use Semaphore\Transformers\EolTransformer;
use Semaphore\Transformers\GaugeTransformer;
use Semaphore\Transformers\TransformerInterface;
use Semaphore\Transformers\TrendTransformer;
use Semaphore\Transformers\ValueTransformer;
use Semaphore\Transformers\VersionTransformer;

class TransformerManager extends Manager
{
    public function createEolDriver(): TransformerInterface
    {
        return resolve(EolTransformer::class);
    }

    public function createGaugeDriver(): TransformerInterface
    {
        return resolve(GaugeTransformer::class);
    }

    public function createTrendDriver(): TransformerInterface
    {
        return resolve(TrendTransformer::class);
    }

    public function createValueDriver(): TransformerInterface
    {
        return resolve(ValueTransformer::class);
    }

    public function createVersionDriver(): TransformerInterface
    {
        return resolve(VersionTransformer::class);
    }

    public function getDefaultDriver()
    {
        throw new Exception('Driver must be provided.', 400);
    }
}
