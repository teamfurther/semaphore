<?php

namespace Tests\Feature;

use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\Tests\Mocks\GetDataFromPrometheusActionTrendMock;
use Semaphore\Tests\TestCase;

class TrendTest extends TestCase
{
    public function testContent()
    {
        $result = [
            'status' => 'success',
            'data' => [
                [
                    'pid' => 1,
                    'processName' => 'systemd',
                    'values' => [
                        [
                            'time' => 1626434335.964,
                            'value' => '0.4'
                        ],
                        [
                            'time' => 1626434335.970,
                            'value' => '0.4'
                        ]
                    ],
                ],
                [
                    'pid' => 2,
                    'processName' => 'test1',
                    'values' => [
                        [
                            'time' => 1626434335.964,
                            'value' => '0.3'
                        ],
                        [
                            'time' => 1626434335.970,
                            'value' => '0.1'
                        ]
                    ],
                ],
                [
                    'pid' => 3,
                    'processName' => 'test2',
                    'values' => [
                        [
                            'time' => 1626434335.964,
                            'value' => '1.4'
                        ]
                    ],
                ],
            ],
        ];

        $url = route('data', ['type' => 'trend']) . '?metric=semaphore_memory_usage&start=2021-01-01&end=2021-01-03&instance=test-instance';

        $response = $this->json('GET', $url);

        $this->assertEquals($result, $response->json());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(GetDataFromPrometheusAction::class, resolve(GetDataFromPrometheusActionTrendMock::class));
    }
}
