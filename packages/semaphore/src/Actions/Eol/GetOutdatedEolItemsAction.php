<?php

namespace Semaphore\Actions\Eol;

use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\EolDTO;

class GetOutdatedEolItemsAction implements ActionInterface
{
    /**
     * @return EolDTO[]
     */
    public function execute(...$args): array
    {
        /** @var EolDTO[] $items */
        $items =$args[0];

        return array_filter($items, fn (EolDTO $eolDTO) => !$eolDTO->activeSupport || !$eolDTO->securitySupport);
    }
}
