<?php

namespace Semaphore\Transformers;

use Semaphore\DataTransferObjects\EolDTO;

class EolTransformer implements TransformerInterface
{
    /** @return EolDTO[] */
    public function transform($data): array
    {
        $result = $data['data']['result'];

        return array_map(function ($item) {
            $metric = $item['metric'];

            return new EolDTO($metric['series'], $metric['version'], 'red');
        }, $result);
    }
}
