<?php

return [
    'project_config_dir' => 'projects',
    'routes' => [
        'domain' => env('APP_URL'),
        'middleware' => [
            'api' => 'api',
            'front' => 'front',
        ],
        'prefix' => 'semaphore',
    ],
];
