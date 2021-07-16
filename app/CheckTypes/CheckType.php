<?php

namespace App\CheckTypes;

use Illuminate\Http\Request;

abstract class CheckType
{
    public abstract function response(Request $request);
}
