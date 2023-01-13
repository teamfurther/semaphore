<?php

namespace Semaphore\AlertMessages;

use Carbon\Carbon;
use Semaphore\Actions\Alerts\GetValueDynamicallyAction;
use Semaphore\DataTransferObjects\AlertDTO;
use Semaphore\DataTransferObjects\ValueDTO;

class ValueAlertMessage implements AlertMessageInterface
{
    private GetValueDynamicallyAction $getValueDynamicallyAction;

    public function __construct()
    {
        $this->getValueDynamicallyAction = resolve(GetValueDynamicallyAction::class);
    }

    /**
     * @param ValueDTO $data
     */
    public function getMessage(AlertDTO $alert, $data): string
    {
        $min = $alert->min;
        $value = $data->value;

        if (is_array($alert->min)) {
            $min = $this->getValueDynamicallyAction->execute($alert->min);
        }

        if (array_key_exists('class', $alert->transformer) && array_key_exists('method', $alert->transformer)) {
            $method = $alert->transformer['method'];
            $class = new $alert->transformer['class'];

            $min = $class->$method($min);
            $value = $class->$method($value);
        }
        return sprintf(
            __('semaphore::alerts.current.lt'),
            $alert->instance,
            $alert->name,
            $value,
            $min,
            $value,
            Carbon::now()->addSeconds($alert->period + 1)->diffForHumans(null, true),
        );
    }
}
