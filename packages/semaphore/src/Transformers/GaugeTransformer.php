<?php

namespace Semaphore\Transformers;

use Semaphore\Actions\Projects\GetMetricProjectConfigAction;
use Semaphore\DataTransferObjects\GaugeDTO;

class GaugeTransformer implements TransformerInterface
{
    private GetMetricProjectConfigAction $getMetricProjectConfigAction;

    public function __construct()
    {
        $this->getMetricProjectConfigAction = resolve(GetMetricProjectConfigAction::class);
    }

    /** @return GaugeDTO[] */
    public function transform($data): array
    {
        $result = $data['data']['result'];

        return array_map(function($item) {
            $metric = $item['metric'];
            $config = $this->getMetricProjectConfigAction->execute($metric['instance'], $metric['__name__']);
            $label = $config['widget']['label'];

            return new GaugeDTO($item['metric'][$label], $item['value'][1]);
        }, $result);
    }
}
