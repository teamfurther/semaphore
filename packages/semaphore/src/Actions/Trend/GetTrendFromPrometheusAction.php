<?php

namespace Semaphore\Actions\Trend;

use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\DataTransferObjects\PrometheusRequestDTO;
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
        /** @var DataRequest $data */
        $data = $args[0];

        return $this->trendTransformer->transform(
            $this->getDataFromPrometheusAction->execute(config('widgets.prometheus.endpoints.trend'), new PrometheusRequestDTO(
                $data->get('end'),
                $data->get('instance'),
                $data->get('metric'),
                $data->get('start'),
            ))
        );
    }
}
