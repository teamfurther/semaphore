<?php

namespace Semaphore\Actions\Projects;

use Semaphore\Actions\ActionInterface;

class GetFullProjectsConfigAction implements ActionInterface
{
    /**
     * @var array<string>
     */
    private array $projects;

    public function execute(...$args): array
    {
        foreach (glob(config('semaphore.project_config_dir') . '/*.*') as $project) {
            $projectConfig = require($project);

            if ($projectConfig && isset($projectConfig['instance'])) {
                $this->projects[$projectConfig['instance']] = $projectConfig;
            }
        }

        return $this->projects;
    }
}