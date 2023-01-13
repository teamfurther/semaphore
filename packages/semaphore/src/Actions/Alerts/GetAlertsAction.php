<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;
use Semaphore\Actions\Projects\GetFullProjectsConfigAction;
use Semaphore\DataTransferObjects\AlertDTO;

class GetAlertsAction implements ActionInterface
{
    private GetFullProjectsConfigAction $getFullProjectsConfigAction;

    public function __construct()
    {
        $this->getFullProjectsConfigAction = resolve(GetFullProjectsConfigAction::class);
    }

    /**
     * @return array<AlertDTO>
     */
    public function execute(...$args): array
    {
        $alerts = [];
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
                    $widget = $check['widget'];

                    if (!is_string($check['widget'])) {
                        $widget = $widget['type'];
                    }

                    $alerts[] = new AlertDTO(
                        $project['instance'],
                        $check['id'],
                        $check['metric'],
                        $check['name'],
                        $alert['channel'],
                        $alert['filter'] ?? null,
                        $alert['max'] ?? 1,
                        $alert['min'] ?? 0,
                        $alert['period'],
                        $widget,
                        $alert['snooze'],
                        (is_array($check['widget']) && array_key_exists('transform', $check['widget']))
                            ? $check['widget']['transform']
                            : []
                    );
                }
            }
        }

        return $alerts;
    }
}
