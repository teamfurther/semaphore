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
        $result = [
            "status" => "success",
            "data" =>  [
                [
                    "product" => "composer",
                    "version" =>  [
                        "major" => 2,
                        "minor" => 3,
                        "patch" => 6,
                    ],
                    "latest" =>  [
                        "major" => 2,
                        "minor" => 4,
                        "patch" => 4,
                    ],
                    "activeSupport" => false,
                    "securitySupport" => false,
                ],
                [
                    "product" => "laravel",
                    "version" =>  [
                        "major" => 8,
                        "minor" => 83,
                        "patch" => 22,
                    ],
                    "latest" =>  [
                        "major" => 9,
                        "minor" => 38,
                        "patch" => 0,
                    ],
                    "activeSupport" => false,
                    "securitySupport" => true,
                ],
                [
                    "product" => "php",
                    "version" =>  [
                        "major" => 8,
                        "minor" => 1,
                        "patch" => 6,
                    ],
                    "latest" =>  [
                        "major" => 8,
                        "minor" => 1,
                        "patch" => 12,
                    ],
                    "activeSupport" => true,
                    "securitySupport" => true,
                ],
            ],
        ];

        $url = route('data', ['type' => 'eol']) . '?metric=semaphore_eol&instance=test-instance';

        $response = $this->json('GET', $url);

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
