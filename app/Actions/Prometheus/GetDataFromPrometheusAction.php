<?php

namespace App\Actions\Prometheus;

use App\Actions\ActionInterface;

class GetDataFromPrometheusAction implements ActionInterface
{
    public function execute(...$args)
    {
        return 1;
    }
}
