<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\Tests\Mocks\GetDataFromPrometheusActionGaugeMock;
use Semaphore\Tests\TestCase;

class GaugeTest extends TestCase
{
    public function testContent()
    {
        $result = [
            'status' => 'success',
            'data' => [
                [
                    'name' => '/',
                    'value' => '0.39',
                ],
                [
                    'name' => '/var/remote_backups',
                    'value' => '1',
                ],
            ],
        ];

        $url = route('data', ['type' => 'gauge']) . '?metric=semaphore_disk_usage';

        $response = $this->json('GET', $url);

        $this->assertEquals($result, $response->json());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(GetDataFromPrometheusAction::class, resolve(GetDataFromPrometheusActionGaugeMock::class));

        $stubFolderPath = dirname(__DIR__) . '/Stubs';
        $this->app->setBasePath($stubFolderPath);

        Config::set('semaphore.project_config_dir', 'projects');
    }
}
