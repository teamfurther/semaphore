<?php

namespace App\Actions;

use Carbon\Carbon;

class ConvertTimestampToDateAction
{
    public function execute(string $timestamp): string {
        return Carbon::parse((int)$timestamp)->format('Y-m-d');
    }
}
