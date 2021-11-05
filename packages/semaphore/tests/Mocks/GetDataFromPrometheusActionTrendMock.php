<?php

namespace Semaphore\Tests\Mocks;

use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;

class GetDataFromPrometheusActionTrendMock extends GetDataFromPrometheusAction
{
    public function execute($endpoint = 'query_range', ...$args): array
    {
        return [
            'status' => 'success',
            'data' => [
                'resultType' => 'vector',
                'result' => [
                    [
                        'metric' => [
                            '__name__' => 'semaphore_memory_usage',
                            'exported_instance' => 'gofurther.digital',
                            'exported_job' => 'semaphore',
                            'instance' => 'gofurther.digital',
                            'job' => 'semaphore',
                            'pid' => '1',
                            'process' => 'systemd'
                        ],
                        'values' => [
                            [
                                1626434335.964,
                                '0.4'
                            ],
                            [
                                1626434335.970,
                                '0.4'
                            ],
                        ]
                    ],
                    [
                        'metric' => [
                            '__name__' => 'semaphore_memory_usage',
                            'exported_instance' => 'gofurther.digital',
                            'exported_job' => 'semaphore',
                            'instance' => 'gofurther.digital',
                            'job' => 'semaphore',
                            'pid' => '2',
                            'process' => 'test1'
                        ],
                        'values' => [
                            [
                                1626434335.964,
                                '0.3'
                            ],
                            [
                                1626434335.970,
                                '0.1'
                            ],
                        ]
                    ],
                    [
                        'metric' => [
                            '__name__' => 'semaphore_memory_usage',
                            'exported_instance' => 'gofurther.digital',
                            'exported_job' => 'semaphore',
                            'instance' => 'gofurther.digital',
                            'job' => 'semaphore',
                            'pid' => '3',
                            'process' => 'test2'
                        ],
                        'values' => [
                            [
                                1626434335.964,
                                '1.4'
                            ]
                        ]
                    ]
                ]
            ],
        ];
    }
}
