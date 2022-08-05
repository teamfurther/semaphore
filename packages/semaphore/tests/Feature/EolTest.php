<?php

namespace Tests\Feature;

use Config;
use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;
use Semaphore\Tests\Mocks\GetDataFromPrometheusActionEolMock;
use Tests\TestCase;

class EolTest extends TestCase
{
    public function testContent()
    {
        $result = [];

        $url = route('data', ['type' => 'eol']) . '?metric=semaphore_eol';

        $response = $this->json('GET', $url);

        dd($response->json());

        $this->assertEquals($result, $response->json());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance(GetDataFromPrometheusAction::class, resolve(GetDataFromPrometheusActionEolMock::class));

        $stubFolderPath = dirname(__DIR__) . '/Stubs';
        $this->app->setBasePath($stubFolderPath);

        Config::set('semaphore.project_config_dir', 'projects');
    }
}
