<?php

namespace Semaphore\Actions\Prometheus;

use Semaphore\Actions\ActionInterface;
use Semaphore\Http\Requests\DataRequest;
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
        /** @var DataRequest $data */
        $data = $args[0];

        $metric = $data->get('metric');
        $start = $data->get('start');
        $end = $data->get('end');
        $instance = $data->get('instance');
        $numberOfSeconds = ($end - $start) / (config('semaphore.prometheus.step') - 1);
        $url = config('semaphore.prometheus.api_end_point') . '/' . $endpoint . '?query=' . $metric . '{exported_instance="'. $instance .'"}&start=' . $start . '&end=' . $end . '&step=' . $numberOfSeconds;

        return json_decode($this->client->get($url)
            ->getBody()
            ->getContents(), true);
    }
}
