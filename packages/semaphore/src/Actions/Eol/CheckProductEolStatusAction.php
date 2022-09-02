<?php

namespace Semaphore\Actions\Eol;

use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\EolDTO;
use Semaphore\Transformers\VersionTransformer;

class CheckProductEolStatusAction implements ActionInterface
{
    private DetermineSupportTruthinessAction $determineSupportTruthinessAction;
    private GetMatchingProductCycleAction $getMatchingProductCycleAction;
    private GetProductCyclesAction $getProductCyclesAction;
    private VersionTransformer $versionTransformer;

    public function __construct()
    {
        $this->determineSupportTruthinessAction = resolve(DetermineSupportTruthinessAction::class);
        $this->getMatchingProductCycleAction = resolve(GetMatchingProductCycleAction::class);
        $this->getProductCyclesAction = resolve(GetProductCyclesAction::class);
        $this->versionTransformer = resolve(VersionTransformer::class);
    }

    public function execute(...$args): ?EolDTO
    {
        /** @var string $product */
        $product = $args[0];
        /** @var string $version */
        $version = $this->versionTransformer->transform($args[1]);

        $cycles = $this->getProductCyclesAction->execute($product);
        $cycle = $this->getMatchingProductCycleAction->execute($cycles, $version);

        if ($cycle) {
            $eol = new EolDto(
                $product,
                $version,
                $this->versionTransformer->transform($cycles[0]->latest),
                $this->determineSupportTruthinessAction->execute($cycle->support),
                $this->determineSupportTruthinessAction->execute($cycle->eol),
            );

            return $eol;
        }

        return null;
    }
}
