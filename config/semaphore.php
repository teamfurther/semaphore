<?php

return [
    'dashboard' => [
        'columns' => [
            'cpu_usage' => [
                'order' => 2,
                'title' => 'CPU',
            ],
            'disk_usage' => [
                'order' => 4,
                'title' => 'Disk Usage',
                'width' => '20%',
            ],
            'global_uptime' => [
                'order' => 1,
                'title' => 'Uptime',
            ],
            'health' => [
                'order' => 0,
                'title' => 'Health',
            ],
            'memory_usage' => [
                'order' => 3,
                'title' => 'Memory',
            ],
        ]
    ]
];