<?php

namespace Semaphore\Actions\Gauge;

use Illuminate\Http\Request;
use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\DataTransferObjects\GaugeDTO;
use Semaphore\Transformers\GaugeTransformer;

class GetGaugeFromPrometheusAction implements ActionInterface
{
    private GaugeTransformer $gaugeTransformer;
    private GetDataFromPrometheusAction $getDataFromPrometheusAction;

    public function __construct()
    {
        $this->gaugeTransformer = resolve(GaugeTransformer::class);
        $this->getDataFromPrometheusAction = resolve(GetDataFromPrometheusAction::class);
    }

    /** @return GaugeDTO[] */
    public function execute(...$args): array
    {
        /** @var Request $request */
        $request = $args[0];

        return $this->gaugeTransformer->transform(
            $this->getDataFromPrometheusAction->execute('query', $request->get('metric'))
        );
    }
}
