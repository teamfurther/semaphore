<?php

namespace App\Actions\Prometheus;

use App\Actions\ActionInterface;
use App\Http\Requests\DataRequest;
use GuzzleHttp\Client;

class GetDataFromPrometheusAction implements ActionInterface
{
    private Client $client;

    public function __construct()
    {
        $this->client = resolve(Client::class);
    }

    /**
     * @param DataRequest $data
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function execute($data = null): array
    {
        $metric = $data->get('metric');
        $start = $data->get('start');
        $end = $data->get('end');
        $url = config('prometheus.api_end_point') . '?query=' . $metric . '&start=' . $start . '&end=' . $end . '&step=' . config('prometheus.step');

        return json_decode($this->client->get($url)
            ->getBody()
            ->getContents(), true);
    }
}
