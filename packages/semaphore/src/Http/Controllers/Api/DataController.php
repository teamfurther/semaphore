<?php

namespace Semaphore\Http\Controllers\Api;

use Semaphore\Http\Requests\DataRequest;
use Semaphore\Managers\WidgetManager;

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
