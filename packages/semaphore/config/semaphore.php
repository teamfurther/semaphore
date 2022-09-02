<?php

return [
    'project_config_dir' => 'projects',
    'prometheus' => [
        'api_endpoint' => 'localhost:9090/api/v1',
        'step' => 50,
    ],
    'routes' => [
        'middleware' => [
            'api' => 'api',
            'front' => 'web',
        ],
        'prefix' => 'semaphore',
    ],
];
