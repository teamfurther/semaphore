<?php

namespace Semaphore\Actions\Alerts;

use Carbon\Carbon;
use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\DataTransferObjects\PrometheusRequestDTO;
use Semaphore\Managers\TransformerManager;

class GetPrometheusDataForAlertAction implements ActionInterface
{
    private GetDataFromPrometheusAction $getDataFromPrometheusAction;
    private TransformerManager $transformerManager;

    public function __construct()
    {
        $this->getDataFromPrometheusAction = resolve(GetDataFromPrometheusAction::class);
        $this->transformerManager = resolve(TransformerManager::class);
    }

    public function execute(...$args)
    {
        /** @var AlertDTO $alert */
        $alert = $args[0];

        try {
            return $this->transformerManager->driver($alert->widget)->transform(
                $this->getDataFromPrometheusAction->execute(config('widgets.prometheus.endpoints.' . $alert->widget), new PrometheusRequestDTO(
                    Carbon::now()->timestamp,
                    $alert->instance,
                    $alert->metric,
                    Carbon::now()->timestamp
                ))
            );
        } catch (\Exception $exception) {
            return null;
        }
    }
}
