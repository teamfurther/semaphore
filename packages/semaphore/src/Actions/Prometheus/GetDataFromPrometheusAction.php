<?php

namespace Semaphore\Actions\Prometheus;

use Semaphore\Actions\ActionInterface;
use Semaphore\DataTransferObjects\PrometheusRequestDTO;
use GuzzleHttp\Client;

class GetDataFromPrometheusAction implements ActionInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = resolve(Client::class);
    }

    /**
     * @param string $endpoint
     * @param mixed ...$args
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute($endpoint = 'query_range', ...$args): array
    {
        /** @var PrometheusRequestDTO $data */
        $data = $args[0];

        $metric = $data->metric;
        $start = $data->start;
        $end = $data->end;
        $instance = $data->instance;
        $url = config('semaphore.prometheus.api_endpoint') . '/' . $endpoint . '?query=' . $metric . '{exported_instance="' . $instance . '"}&start=' . $start . '&end=' . $end . '&step=' . config('semaphore.prometheus.step');

        return json_decode($this->client->get($url)
            ->getBody()
            ->getContents(), true);
    }
}
