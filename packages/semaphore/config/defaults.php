<?php

return [
    'console' => [
        'help_pad_length' => 15,
    ],
    'eol' => [
        'api_endpoint' => 'https://endoflife.date/api/'
    ],
    'project_config_dir' => 'projects',
    'prometheus' => [
        'api_endpoint' => 'localhost:9090/api/v1',
        'step' => 50,
    ],
    'routes' => [
        'domain' => env('APP_URL'),
        'middleware' => [
            'api' => 'api',
            'front' => 'web',
        ],
        'prefix' => 'semaphore',
    ],
    'version' => 'v1.0',
];
