<?php

namespace Semaphore\Http\Controllers\Api;

class ProjectsController
{
//    private WidgetManager $widget;

    public function __construct()
    {
//        $this->widget = resolve(WidgetManager::class);
    }

    public function show(string $project)
    {
        return require(base_path(config('semaphore.project_config_dir') . '/' . $project . '.php'));
    }
}
