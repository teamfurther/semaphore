<?php

namespace Semaphore\Tests\Mocks;

use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;

class GetDataFromPrometheusActionEolMock extends GetDataFromPrometheusAction
{
    public function execute($endpoint = 'query_range', ...$args): array
    {
        return [
            "status" => "success",
            "data" => [
                "resultType" => "vector",
                "result" => [
                    [
                        "metric" => [
                            "__name__" => "semaphore_eol",
                            "exported_instance" => "gofurther.digital",
                            "exported_job" => "semaphore",
                            "filesystem" => "/dev/root",
                            "instance" => "gofurther.digital",
                            "job" => "semaphore",
                            "series" => "composer",
                            "version" => "2.3.6"
                        ],
                        "value" => [
                            1637933398.222,
                            "1"
                        ]
                    ],
                    [
                        "metric" => [
                            "__name__" => "semaphore_eol",
                            "exported_instance" => "gofurther.digital",
                            "exported_job" => "semaphore",
                            "filesystem" => "/dev/root",
                            "instance" => "gofurther.digital",
                            "job" => "semaphore",
                            "series" => "laravel",
                            "version" => "8.83.22"
                        ],
                        "value" => [
                            1637933398.222,
                            "1"
                        ]
                    ],
                    [
                        "metric" => [
                            "__name__" => "semaphore_eol",
                            "exported_instance" => "gofurther.digital",
                            "exported_job" => "semaphore",
                            "filesystem" => "/dev/root",
                            "instance" => "gofurther.digital",
                            "job" => "semaphore",
                            "series" => "php",
                            "version" => "8.1.6"
                        ],
                        "value" => [
                            1637933398.222,
                            "1"
                        ]
                    ],
                ],
            ],
        ];
    }
}
