<?php

namespace Semaphore\Actions\Eol;

use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\VersionDTO;

class GetMatchingProductCycleAction implements ActionInterface
{
    public function execute(...$args): ?object
    {
        /** @var array $cycles */
        $cycles = $args[0];
        /** @var VersionDTO $version */
        $version = $args[1];

        foreach ($cycles as $cycle) {
            if (in_array($cycle->cycle, [
                $version->majorMinor(),
                $version->unspecifiedMinor(),
                $version->major
            ])) {
                return $cycle;
            }
        }

        return null;
    }
}
