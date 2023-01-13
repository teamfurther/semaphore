<?php

namespace Semaphore\Checks;

use Semaphore\Actions\Eol\GetOutdatedEolItemsAction;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\DataTransferObjects\EolDTO;

class EolCheck implements CheckInterface
{
    private GetOutdatedEolItemsAction $getOutdatedEolItemsAction;

    public function __construct()
    {
        $this->getOutdatedEolItemsAction = resolve(GetOutdatedEolItemsAction::class);
    }

    /**
     * @param EolDTO[] $widget
     */
    public function check(AlertDTO $alert, $widget): bool
    {
        return count($this->getOutdatedEolItemsAction->execute($widget)) > 0;
    }
}
