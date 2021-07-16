<?php

namespace App\Http\Api\Controllers;

use App\Managers\WidgetManager;
use Illuminate\Http\Request;

class DataController
{
    private WidgetManager $widget;

    public function __construct()
    {
        $this->widget = resolve(WidgetManager::class);
    }

    public function index(string $type, Request $request)
    {
        return $this->widget->driver($type)->response($request);
    }
}
