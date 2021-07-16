<?php

namespace App\Widgets;

use Illuminate\Http\Request;

abstract class Widget
{
    public abstract function response(Request $request);
}
