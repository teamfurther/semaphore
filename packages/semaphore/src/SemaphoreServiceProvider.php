<?php

namespace Semaphore;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Semaphore\Commands\AlertsCommand;

class SemaphoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // load routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/front.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // load translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'semaphore');

        // load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'semaphore');

        // publish assets
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/semaphore'),
        ], 'semaphore-public');

        // publish config
        $this->publishes([
            __DIR__ . '/../config/semaphore.php' => config_path('alerts.php'),
            __DIR__ . '/../config/widgets.php' => config_path('widgets.php'),
        ], 'semaphore-config');

        // publish translation so they can be overridden
        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/semaphore'),
        ]);

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

        //schedule alerts process command
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('semaphore:alerts process')->everyMinute();
        });
    }

    public function register()
    {
        // merge default package configuration
        $this->mergeConfigFrom(
            __DIR__ . '/../config/defaults.php', 'semaphore'
        );
    }
}
