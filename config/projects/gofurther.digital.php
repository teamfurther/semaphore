<?php

return [

    'instance' => 'gofurther.digital',
    'name' => 'gofurther.digital',
    'url' => 'https://gofurther.digital',

    'check_types' => [
        'cpu_usage' => [
            'panel' => [
                'class' => 'col-span-3',
                'order' => 2,
                'row' => 0,
                'title' => 'CPU Usage',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_cpu_usage',
            'type' => 'trend',
        ],
        'disk_io' => [
            'panel' => [
                'class' => 'col-span-3',
                'order' => 6,
                'row' => 0,
                'title' => 'Disk IO',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_disk_io',
            'type' => 'trend',
        ],
        'disk_usage' => [
            'panel' => [
                'class' => 'col-span-3',
                'order' => 1,
                'row' => 0,
                'title' => 'Disk Usage',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_disk_usage',
            'type' => 'gauge',
        ],
        'end_of_life' => [
            'panel' => [
                'class' => null,
                'order' => 0,
                'title' => 'End of Life',
                'zone' => 'sidebar',
            ],
            'metric' => 'semaphore_end_of_life',
            'type' => 'eol',
        ],
        'global_uptime' => [
            'panel' => [
                'class' => 'col-span-3',
                'order' => 0,
                'row' => 0,
                'title' => 'Global Uptime',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_global_uptime',
            'type' => 'uptime',
        ],
        'last_db_backup' => [
            'panel' => [
                'class' => null,
                'order' => 1,
                'title' => 'Last Backup (DB)',
                'zone' => 'sidebar',
            ],
            'metric' => 'semaphore_last_db_backup',
            'type' => 'value',
        ],
        'last_file_backup' => [
            'panel' => [
                'class' => null,
                'order' => 2,
                'title' => 'Last Backup (Files)',
                'zone' => 'sidebar',
            ],
            'metric' => 'semaphore_last_file_backup',
            'type' => 'value',
        ],
        'memory_usage' => [
            'panel' => [
                'class' => 'col-span-3',
                'order' => 3,
                'row' => 0,
                'title' => 'Memory Usage',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_memory_usage',
            'type' => 'trend',
        ],
        'mysql_status' => [
            'panel' => [
                'class' => 'col-span-2',
                'order' => 2,
                'row' => 1,
                'title' => 'MySQL Status',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_mysql_status',
            'type' => 'uptime',
        ],
        'nginx_status' => [
            'panel' => [
                'class' => 'col-span-2',
                'order' => 1,
                'row' => 1,
                'title' => 'nginx Status',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_nginx_status',
            'type' => 'uptime',
        ],
        'response_time' => [
            'panel' => [
                'class' => 'col-span-3',
                'order' => 5,
                'row' => 0,
                'title' => 'Server Response Time',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_response_time',
            'type' => 'trend',
        ],
        'ssl_status' => [
            'panel' => [
                'class' => 'col-span-2',
                'order' => 0,
                'row' => 1,
                'title' => 'SSL Status',
                'zone' => 'main',
            ],
            'metric' => 'semaphore_ssl_status',
            'type' => 'uptime',
        ],
    ],

];