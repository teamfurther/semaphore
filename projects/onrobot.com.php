<?php

return [
//    'instance' => 'onrobot.com',
//    'url' => 'https://onrobot.com',
//    'checks' => [
//        [
//            'id' => 'cpu_usage',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'filter' => 'process=\'total\'',
//                    'max' => .9,
//                    'period' => 3 * 60, // 3 minutes
//                ],
//            ],
//            'metric' => 'semaphore_cpu_usage',
//            'panel' => [
//                'className' => 'col-span-3',
//                'order' => 2,
//                'row' => 0,
//                'title' => 'CPU Usage',
//                'zone' => 'main',
//            ],
//            'widget' => 'trend',
//        ],
//        [
//            'id' => 'disk_io',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'filter' => 'process=\'total\'',
//                    'max' => .9,
//                    'period' => 3 * 60, // 3 minutes
//                ],
//            ],
//            'metric' => 'semaphore_disk_io',
//            'panel' => [
//                'className' => 'col-span-3',
//                'order' => 6,
//                'row' => 0,
//                'title' => 'Disk IO',
//                'zone' => 'main',
//            ],
//            'widget' => 'trend',
//        ],
//        [
//            'id' => 'disk_usage',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'filter' => 'mounted=\'/\'',
//                    'max' => .8,
//                    'period' => 0, // current
//                ],
//                [
//                    'channel' => 'slack',
//                    'filter' => 'mounted=\'/var/remote_backups\'',
//                    'max' => .9,
//                    'period' => 0, // current
//                ],
//            ],
//            'metric' => 'semaphore_disk_usage',
//            'panel' => [
//                'className' => 'col-span-3',
//                'order' => 1,
//                'row' => 0,
//                'title' => 'Disk Usage',
//                'zone' => 'main',
//            ],
//            'widget' => 'gauge',
//        ],
//        [
//            'id' => 'end_of_life',
//            'metric' => 'semaphore_eol',
//            'panel' => [
//                'className' => 'mb-4',
//                'order' => 0,
//                'title' => 'End of Life',
//                'zone' => 'sidebar',
//            ],
//            'widget' => 'eol',
//        ],
//        [
//            'id' => 'global_uptime',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'min' => .99,
//                    'period' => 24 * 60 * 60, // 1 day
//                ],
//            ],
//            'metric' => 'semaphore_global_uptime',
//            'panel' => [
//                'className' => 'col-span-3',
//                'order' => 0,
//                'row' => 0,
//                'title' => 'Global Uptime',
//                'zone' => 'main',
//            ],
//            'widget' => 'uptime',
//        ],
//        [
//            'id' => 'last_db_backup',
//            'metric' => 'semaphore_last_db_backup',
//            'panel' => [
//                'className' => 'mb-4',
//                'order' => 1,
//                'title' => 'Last Backup (DB)',
//                'zone' => 'sidebar',
//            ],
//            'widget' => 'value',
//        ],
//        [
//            'id' => 'last_file_backup',
//            'metric' => 'semaphore_last_file_backup',
//            'panel' => [
//                'order' => 2,
//                'title' => 'Last Backup (Files)',
//                'zone' => 'sidebar',
//            ],
//            'widget' => 'value',
//        ],
//        [
//            'id' => 'memory_usage',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'filter' => 'process=\'total\'',
//                    'max' => .9,
//                    'period' => 3 * 60, // 3 minutes
//                ],
//            ],
//            'metric' => 'semaphore_memory_usage',
//            'panel' => [
//                'className' => 'col-span-3',
//                'order' => 3,
//                'row' => 0,
//                'title' => 'Memory Usage',
//                'zone' => 'main',
//            ],
//            'widget' => 'trend',
//        ],
//        [
//            'id' => 'mysql_status',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'min' => 1,
//                    'period' => 60, // 1 minute
//                ]
//            ],
//            'metric' => 'semaphore_mysql_status',
//            'panel' => [
//                'className' => 'col-span-2',
//                'order' => 2,
//                'row' => 1,
//                'title' => 'MySQL Status',
//                'zone' => 'main',
//            ],
//            'widget' => 'uptime',
//        ],
//        [
//            'id' => 'nginx_status',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'min' => 1,
//                    'period' => 60, // 1 minute
//                ],
//            ],
//            'metric' => 'semaphore_nginx_status',
//            'panel' => [
//                'className' => 'col-span-2',
//                'order' => 1,
//                'row' => 1,
//                'title' => 'nginx Status',
//                'zone' => 'main',
//            ],
//            'widget' => 'uptime',
//        ],
//        [
//            'id' => 'response_time',
//            'metric' => 'semaphore_response_time',
//            'panel' => [
//                'className' => 'col-span-3',
//                'order' => 5,
//                'row' => 0,
//                'title' => 'Server Response Time',
//                'zone' => 'main',
//            ],
//            'widget' => 'trend',
//        ],
//        [
//            'id' => 'ssl_status',
//            'alerts' => [
//                [
//                    'channel' => 'slack',
//                    'min' => .99,
//                    'period' => 3 * 60, // 3 minutes
//                ]
//            ],
//            'metric' => 'semaphore_ssl_status',
//            'panel' => [
//                'className' => 'col-span-2',
//                'order' => 0,
//                'row' => 1,
//                'title' => 'SSL Status',
//                'zone' => 'main',
//            ],
//            'widget' => 'uptime',
//        ]
//    ]
];
