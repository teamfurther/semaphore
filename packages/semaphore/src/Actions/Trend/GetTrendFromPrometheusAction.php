<?php

namespace Semaphore\Actions\Trend;

use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\DataTransferObjects\TrendDTO;
use Semaphore\Http\Requests\DataRequest;
use Semaphore\Transformers\TrendTransformer;

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
     * @param DataRequest $data
     * @return TrendDTO[]
     */
    public function execute(...$args): array
    {
        /** @var string $data */
        $data = $args[0];

        return $this->trendTransformer->transform($this->getDataFromPrometheusAction->execute('query_range', $data));
    }
}
