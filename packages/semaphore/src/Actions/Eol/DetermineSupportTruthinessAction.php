<?php

namespace Semaphore\Actions\Eol;

use Carbon\Carbon;
use Semaphore\Actions\ActionInterface;

class DetermineSupportTruthinessAction implements ActionInterface
{
    public function execute(...$args): bool
    {
        /** @var mixed $support */
        $support = $args[0];

        if (!isset($support)) {
            return false;
        }

        if (is_bool($support) && $support) {
            return true;
        }

        try {
            $supportDate = new Carbon($support);

            if ($supportDate->isFuture()) {
                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}
