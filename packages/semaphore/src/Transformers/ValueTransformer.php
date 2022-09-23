<?php

namespace Semaphore\Transformers;

use Semaphore\Actions\Projects\GetMetricProjectConfigAction;
use Semaphore\DataTransferObjects\ValueDTO;

class ValueTransformer implements TransformerInterface
{
    private GetMetricProjectConfigAction $getMetricProjectConfigAction;

    public function __construct()
    {
        $this->getMetricProjectConfigAction = resolve(GetMetricProjectConfigAction::class);
    }

    public function transform($data): ValueDTO
    {
        $result = $data['data']['result'][0];

        $config = $this->getMetricProjectConfigAction->execute($result['metric']['instance'], $result['metric']['__name__']);

        $value = $result['value'][1];

        $class = new $config['widget']['transform']['class'];
        $method = $config['widget']['transform']['method'];

        return new ValueDTO($class->$method($value));
    }
}
