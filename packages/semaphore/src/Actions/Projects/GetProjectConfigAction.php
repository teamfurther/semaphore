<?php

namespace Semaphore\Actions\Projects;

use Semaphore\Actions\ActionInterface;

class GetProjectConfigAction implements ActionInterface
{
    public function execute(...$args): array
    {
        return require(base_path(config('semaphore.project_config_dir') . '/' . $args[0] . '.php'));
    }
}