<?php

namespace Semaphore\Transformers;

use Semaphore\Actions\Eol\CheckProductEolStatusAction;
use Semaphore\DataTransferObjects\EolDTO;

class EolTransformer implements TransformerInterface
{
    private CheckProductEolStatusAction $checkProductEolStatusAction;

    public function __construct()
    {
        $this->checkProductEolStatusAction = resolve(CheckProductEolStatusAction::class);
    }

    /** @return EolDTO[] */
    public function transform($data): array
    {
        $result = $data['data']['result'];

        return array_filter(
            array_map(function ($item) {
                $metric = $item['metric'];

                return $this->checkProductEolStatusAction->execute($metric['series'], $metric['version']);
            }, $result),
            fn ($currentItem) => $currentItem
        );
    }
}
