<?php

namespace Semaphore\Actions\Value;

use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\DataTransferObjects\ValueDTO;
use Semaphore\Transformers\ValueTransformer;

class GetValueFromPrometheusAction implements ActionInterface
{
    private GetDataFromPrometheusAction $getDataFromPrometheusAction;
    private ValueTransformer $valueTransformer;

    public function __construct()
    {
        $this->getDataFromPrometheusAction = resolve(GetDataFromPrometheusAction::class);
        $this->valueTransformer = resolve(ValueTransformer::class);
    }

    public function execute(...$args): ValueDTO
    {
        /** @var Request $request */
        $request = $args[0];

        return $this->valueTransformer->transform(
            $this->getDataFromPrometheusAction->execute('query', $request)
        );
    }
}
