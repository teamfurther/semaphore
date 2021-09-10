<?php

namespace Semaphore;

use Illuminate\Support\ServiceProvider;
use Semaphore\Commands\AlertsCommand;

class SemaphoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/front.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'semaphore');

        // publish assets
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/semaphore'),
        ], 'semaphore-public');

        // publish config
        $this->publishes([
            __DIR__ . '/../config/semaphore.php' => config_path('semaphore.php'),
        ], 'semaphore-config');

        // publish views so they can be overridden
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/semaphore'),
        ], 'semaphore-views');

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                AlertsCommand::class,
            ]);
        }
    }

    public function register()
    {
        // merge default package configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/defaults.php', 'semaphore'
        );

        // merge project configurations
        foreach (glob(config('semaphore.project_config_dir') . '/*.*') as $project) {
            $this->mergeConfigFrom(
                $project, 'semaphore_projects'
            );
        }
    }
}
