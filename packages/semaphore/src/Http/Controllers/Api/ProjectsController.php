<?php

namespace Semaphore\Http\Controllers\Api;

use Semaphore\Actions\Projects\GetFullProjectsConfigAction;
use Semaphore\Actions\Projects\GetProjectConfigAction;

class ProjectsController
{
    private GetFullProjectsConfigAction $getFullProjectsConfigAction;
    private GetProjectConfigAction $getProjectConfigAction;

    public function __construct()
    {
        $this->getFullProjectsConfigAction = resolve(GetFullProjectsConfigAction::class);
        $this->getProjectConfigAction = resolve(GetProjectConfigAction::class);
    }

    public function index()
    {
        return $this->getFullProjectsConfigAction->execute();
    }

    public function show(string $project)
    {
        return $this->getProjectConfigAction->execute($project);
    }
}
