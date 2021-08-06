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
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute(...$args): array
    {
        /** @var DataRequest $data */
        $data = $args[0];

        $metric = $data->get('metric');
        $start = $data->get('start');
        $end = $data->get('end');
        $url = config('prometheus.api_end_point') . '?query=' . $metric . '&start=' . $start . '&end=' . $end . '&step=' . config('prometheus.step');

        return json_decode($this->client->get($url)
            ->getBody()
            ->getContents(), true);
    }
}
