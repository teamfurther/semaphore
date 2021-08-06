<?php

namespace Semaphore\Transformers;

use Semaphore\DataTransferObjects\TrendDTO;
use Semaphore\DataTransferObjects\ValueTimeDTO;

class TrendTransformer implements TransformerInterface
{
    /** @return TrendDTO[] */
    public function transform($data): array
    {
        $trends = [];
        $result = $data['data']['result'];

        foreach ($result as $item) {
            $values = array_map(function ($value) {
                return new ValueTimeDTO($value[0], $value[1]);
            }, $item['values']);

            $trends[] = new TrendDTO(
                $item['metric']['pid'],
                $item['metric']['process'],
                $values
            );
        }

        return $trends;
    }
}
