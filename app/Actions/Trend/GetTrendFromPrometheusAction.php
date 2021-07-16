<?php

namespace App\Actions\Trend;

use App\Actions\ActionInterface;
use App\Actions\Prometheus\GetDataFromPrometheusAction;
use App\DataTransferObjects\TrendDTO;
use App\Transformers\TrendTransformer;

class GetTrendFromPrometheusAction implements ActionInterface
{
    private GetDataFromPrometheusAction $getDataFromPrometheusAction;
    private TrendTransformer $trendTransformer;

    public function __construct()
    {
        $this->getDataFromPrometheusAction = resolve(GetDataFromPrometheusAction::class);
        $this->trendTransformer = resolve(TrendTransformer::class);
    }

    /**
     * @param string $data
     * @return TrendDTO[]
     */
    public function execute($data = null): array
    {
        return $this->trendTransformer->transform($this->getDataFromPrometheusAction->execute());
    }
}
