<?php

namespace Semaphore\Checks;

use Semaphore\Actions\Alerts\GetValueDynamicallyAction;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\DataTransferObjects\ValueDTO;

class ValueCheck implements CheckInterface
{
    private GetValueDynamicallyAction $getValueDynamicallyAction;

    public function __construct()
    {
        $this->getValueDynamicallyAction = resolve(GetValueDynamicallyAction::class);
    }

    /**
     * @param ValueDTO $widget
     */
    public function check(AlertDTO $alert, $widget): bool
    {
        $min = $alert->min;

        if (!$widget) {
            return false;
        }

        if (is_array($alert->min)) {
            $object = $this->getValueDynamicallyAction->execute($alert->min);

            if (!$object) {
                throw new \Exception();
            }

            $min = $object;
        }

        return $widget->value < $min;
    }
}
