<?php

namespace Semaphore\Widgets;

use Illuminate\Http\Request;

abstract class Widget
{
    public abstract function response(Request $request);
}
