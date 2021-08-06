<?php

namespace Semaphore\Commands;

use Illuminate\Cache\CacheManager;
use Illuminate\Console\Command;
use Semaphore\Actions\Alerts\CheckIfAlertsAreOnAction;
use Semaphore\Actions\Alerts\GetAlertsAction;

class AlertsCommand extends Command
{
    private CacheManager $cache;
    private CheckIfAlertsAreOnAction $checkIfAlertsAreOnAction;
    private GetAlertsAction $getAlertsAction;

    /**
     * @var string
     */
    protected $description = 'Handles Semaphore alerts.';

    /**
     * @var string
     */
    protected $signature = 'semaphore:alerts {action=help}';

    public function __construct(
        CacheManager $cache,
        CheckIfAlertsAreOnAction $checkIfAlertsAreOnAction,
        GetAlertsAction $getAlertsAction
    )
    {
        parent::__construct();

        $this->cache = $cache;
        $this->checkIfAlertsAreOnAction = $checkIfAlertsAreOnAction;
        $this->getAlertsAction = $getAlertsAction;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $action = $this->argument('action');

        switch ($action) {
            case 'help': {
                $padLength = config('semaphore.console.help_pad_length');

                $this->info('Semaphore ' . config('semaphore.version'));
                $this->newLine();
                $this->warn(__('Usage:'));
                $this->info('php artisan semaphore:alerts {action}');
                $this->newLine();
                $this->warn(__('Available actions:'));
                $this->info(str_pad("  help", $padLength) . __('Shows this help page.'));
                $this->info(str_pad("  process", $padLength) . __('Processes and sends alerts.'));
                $this->info(str_pad("  help", $padLength) . __('Starts the automatic processing of alerts.'));
                $this->info(str_pad("  status", $padLength) . __('Shows the status of automatic processing.'));
                $this->info(str_pad("  stop", $padLength) . __('Stops the automatic processing of alerts.'));


                break;
            }
            case 'process': {
                if ($this->checkIfAlertsAreOnAction->execute()) {
                    $alerts = $this->getAlertsAction->execute();
                }

                break;
            }
            case 'start': {
                $this->cache->forever('alerts_on', 1);

                $this->info(__('Semaphore alerts are now ON.'));

                break;
            }
            case 'status': {
                if ($this->checkIfAlertsAreOnAction->execute()) {
                    $this->info(__('Semaphore alerts are ON.'));
                } else {
                    $this->error(__('Semaphore alerts are OFF.'));
                }

                break;
            }
            case 'stop': {
                $this->cache->forever('alerts_on', 0);

                $this->error(__('Semaphore alerts are now OFF.'));

                break;
            }
        }
    }
}
