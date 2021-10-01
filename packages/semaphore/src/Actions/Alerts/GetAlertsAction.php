<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Projects\GetFullProjectsConfigAction;

class GetAlertsAction implements ActionInterface
{
    /** @var array <string> */
    private array $alerts = [];
    private GetFullProjectsConfigAction $getFullProjectsConfigAction;

    public function __construct()
    {
        $this->getFullProjectsConfigAction = resolve(GetFullProjectsConfigAction::class);
    }

    public function execute(...$args): array
    {
        $projects = $this->getFullProjectsConfigAction->execute();

        foreach ($projects as $project) {
            if (!isset($project['checks'])) {
                continue;
            }

            foreach ($project['checks'] as $check) {
                if (!isset($check['alerts'])) {
                    continue;
                }

                foreach ($check['alerts'] as $alert) {
                    $this->alerts[] = [
                        'instance' => $project['instance'],
                        'id' => $check['id'],
                        'metric' => $check['metric'],
                        'name' => $check['name'],
                        'channel' => $alert['channel'],
                        'filter' => $alert['filter'] ?? null,
                        'max' => $alert['max'] ?? 1,
                        'min' => $alert['min'] ?? 0,
                        'period' => $alert['period'],
                    ];
                }
            }
        }

        return $this->alerts;
    }
}