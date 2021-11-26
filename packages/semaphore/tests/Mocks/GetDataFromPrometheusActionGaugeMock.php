<?php

namespace Semaphore\Tests\Mocks;

use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;

class GetDataFromPrometheusActionGaugeMock extends GetDataFromPrometheusAction
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
                            "__name__" => "semaphore_disk_usage",
                            "exported_instance" => "gofurther.digital",
                            "exported_job" => "semaphore",
                            "filesystem" => "/dev/root",
                            "instance" => "gofurther.digital",
                            "job" => "semaphore",
                            "mounted" => "/"
                        ],
                        "value" => [
                            1637933398.222,
                            "0.39"
                        ]
                    ],
                    [
                        "metric" => [
                            "__name__" => "semaphore_disk_usage",
                            "exported_instance" => "gofurther.digital",
                            "exported_job" => "semaphore",
                            "filesystem" => "/dev/sdc",
                            "instance" => "gofurther.digital",
                            "job" => "semaphore",
                            "mounted" => "/var/remote_backups"
                        ],
                        "value" => [
                            1637933398.222,
                            "1"
                        ]
                    ],
                ]
            ]
        ];
    }
}
