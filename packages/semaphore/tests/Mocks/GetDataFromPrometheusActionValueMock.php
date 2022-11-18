<?php

namespace Semaphore\Tests\Mocks;

use Semaphore\Actions\Prometheus\GetDataFromPrometheusAction;

class GetDataFromPrometheusActionValueMock extends GetDataFromPrometheusAction
{
    public function execute($endpoint = 'query_range', ...$args): array
    {
        return [
            "status" => "success",
            "data" =>  [
                "resultType" => "vector",
                "result" => [
                    0 => [
                        "metric" => [
                            "__name__" => "semaphore_last_backup_db",
                            "exported_instance" => "gofurther.digital",
                            "exported_job" => "semaphore",
                            "instance" => "gofurther.digital",
                            "job" => "semaphore",
                        ],
                        "value" => [
                            0 => 1663935551.935,
                            1 => "1663884000",
                        ]
                    ]
                ]
            ]
        ];
    }
}
