<?php

return [
    'console' => [
        'help_pad_length' => 15,
    ],
    'project_config_dir' => 'projects',
    'prometheus' => [
        'api_end_point' => 'http://139.162.182.147:9090/api/v1/query_range',
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
