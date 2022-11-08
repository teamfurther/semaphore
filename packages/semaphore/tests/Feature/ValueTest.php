<?php

namespace Tests\Feature;

use Config;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\Tests\Mocks\GetDataFromPrometheusActionValueMock;
use Tests\TestCase;

class ValueTest extends TestCase
{
    public function testContent()
    {
        $this->withoutExceptionHandling();

        $result = [
            'status' => 'success',
            'data' => [
               'value' => '2022-09-22',
            ],
        ];

        $url = route('data', ['type' => 'value']) . '?metric=semaphore_last_backup_db';

        $response = $this->json('GET', $url);

        $this->assertEquals($result, $response->json());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(GetDataFromPrometheusAction::class, resolve(GetDataFromPrometheusActionValueMock::class));

        $stubFolderPath = dirname(__DIR__) . '/Stubs';
        $this->app->setBasePath($stubFolderPath);

        Config::set('semaphore.project_config_dir', 'projects');
    }
}
