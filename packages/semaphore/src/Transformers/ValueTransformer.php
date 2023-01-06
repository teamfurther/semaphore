<?php

namespace Semaphore\Transformers;

use Semaphore\Actions\Projects\GetMetricProjectConfigAction;
use Semaphore\DataTransferObjects\ValueDTO;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ValueTransformer implements TransformerInterface
{
    private GetMetricProjectConfigAction $getMetricProjectConfigAction;

    public function __construct()
    {
        $this->getMetricProjectConfigAction = resolve(GetMetricProjectConfigAction::class);
    }

    public function transform($data, bool $withTransformation = false): ValueDTO
    {
        if (empty($data['data']['result'])) {
            throw new NotFoundHttpException('Value not found');
        }

        $result = $data['data']['result'][0];

        $config = $this->getMetricProjectConfigAction->execute($result['metric']['instance'], $result['metric']['__name__']);

        $value = $result['value'][1];

        if (!$withTransformation) {
            return new ValueDTO($value);
        }

        $class = new $config['widget']['transform']['class'];
        $method = $config['widget']['transform']['method'];

        return new ValueDTO($class->$method($value));
    }
}
