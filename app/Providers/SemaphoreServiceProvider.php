<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SemaphoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    public function register()
    {
        // merge default package configuration
        $this->mergeConfigFrom(
//            __DIR__ . '../../config/defaults.php', 'semaphore'
            'config/defaults.php', 'semaphore'
        );

        // merge project configurations
        foreach (glob(config('semaphore.project_config_dir') . '/*.*') as $project) {
            $this->mergeConfigFrom(
                $project, 'semaphore_projects'
            );
        }
    }
}
