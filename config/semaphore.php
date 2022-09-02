<?php

return [
    'project_config_dir' => 'projects',
    'prometheus' => [
        'api_endpoint' => 'http://139.162.182.147:9090/api/v1',
        'step' => 50,
    ],
    'routes' => [
        'middleware' => [
            'api' => 'api',
            'front' => 'front',
        ],
        'prefix' => 'semaphore',
    ],
];
