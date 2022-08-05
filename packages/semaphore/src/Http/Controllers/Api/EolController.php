<?php

namespace Semaphore\Http\Controllers\Api;

use Semaphore\Actions\Eol\CheckProductEolStatusAction;

class EolController
{
    private CheckProductEolStatusAction $checkProductEolStatusAction;

    public function __construct()
    {
        $this->checkProductEolStatusAction = resolve(CheckProductEolStatusAction::class);
    }

    public function show(string $product, string $version)
    {
        return $this->checkProductEolStatusAction->execute($product, $version);
    }
}
