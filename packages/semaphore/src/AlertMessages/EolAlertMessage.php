<?php

namespace Semaphore\AlertMessages;

use Semaphore\Actions\Eol\GetOutdatedEolItemsAction;
use Semaphore\DataTransferObjects\AlertDTO;

class EolAlertMessage implements AlertMessageInterface
{
    private GetOutdatedEolItemsAction $getOutdatedEolItemsAction;

    public function __construct()
    {
        $this->getOutdatedEolItemsAction = resolve(GetOutdatedEolItemsAction::class);
    }

    public function getMessage(AlertDTO $alert, $data): string
    {
        $data = $this->getOutdatedEolItemsAction->execute($data);
        $message = sprintf(
            "*%1\$s*\n",
            $alert->instance,
        );

        foreach ($data as $item) {
            $message .= sprintf(
                __('semaphore::alerts.current.outdated'),
                $item->product,
                $item->version->version(),
                $item->latest->version(),
                $item->activeSupport ? 'Yes' : 'No',
                $item->securitySupport ? 'Yes' : 'No',
            );
        }

        return $message;
    }
}
