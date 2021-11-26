<?php

namespace Semaphore\Actions\Projects;

use Semaphore\Actions\ActionInterface;

class GetMetricProjectConfigAction implements ActionInterface
{
    public function execute(...$args)
    {
        $projectName = $args[0];
        $metricName = $args[1];

        $config = require(base_path(config('semaphore.project_config_dir') . '/' . $projectName . '.php'));

        foreach ($config['checks'] as $check) {
            if ($check['metric'] == $metricName) {
                return $check;
            }
        }

        return '';
    }
}
