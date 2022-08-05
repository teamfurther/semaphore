<?php

namespace Semaphore\Actions\Eol;

use GuzzleHttp\Client;
use Semaphore\Actions\ActionInterface;

class GetProductCyclesAction implements ActionInterface
{
    public function execute(...$args): array
    {
        /** @var string $product */
        $product = $args[0];

        try {
            $client = new Client();
            $result = $client->request('GET', config('semaphore.eol.api_endpoint') . '/' . $product);

            if ($result->getStatusCode() === 200) {
                return json_decode($result->getBody());
            }

            return [];
        } catch (\Exception $e) {
            return [];
        }
    }
}
