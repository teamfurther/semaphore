<?php

namespace Semaphore\Actions\Eol;

use Illuminate\Http\Request;
use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\DataTransferObjects\EolDTO;
use Semaphore\DataTransferObjects\PrometheusRequestDTO;
use Semaphore\Transformers\EolTransformer;

class GetEolFromPrometheusAction implements ActionInterface
{
    private EolTransformer $eolTransformer;
    private GetDataFromPrometheusAction $getDataFromPrometheusAction;

    public function __construct()
    {
        $this->eolTransformer = resolve(EolTransformer::class);
        $this->getDataFromPrometheusAction = resolve(GetDataFromPrometheusAction::class);
    }

    /** @return EolDTO[] */
    public function execute(...$args): array
    {
        /** @var Request $request */
        $request = $args[0];

        return $this->eolTransformer->transform(
            $this->getDataFromPrometheusAction->execute(config('widgets.prometheus.endpoints.eol'), new PrometheusRequestDTO(
                $request->get('end'),
                $request->get('instance'),
                $request->get('metric'),
                $request->get('start'),
            ))
        );
    }
}
