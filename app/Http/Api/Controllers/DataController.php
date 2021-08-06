<?php

namespace App\Http\Api\Controllers;

use App\Http\Requests\DataRequest;
use App\Managers\WidgetManager;

class DataController
{
    private WidgetManager $widget;

    public function __construct()
    {
        $this->widget = resolve(WidgetManager::class);
    }

    public function index(string $type, DataRequest $request)
    {
        return $this->widget->driver($type)->response($request);
    }
}
