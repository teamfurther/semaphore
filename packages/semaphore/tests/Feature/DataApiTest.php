<?php

namespace Semaphore\Tests\Feature;

use Semaphore\Tests\TestCase;

class DataApiTest extends TestCase
{
    public function testWithoutMetricParam()
    {
        dd(route('data', ['type' => 'trend']));
        $response = $this->json('GET', route('data', ['type' => 'trend']) . '?start=' . time() . '&end=' . time());

        $response->assertStatus(422);
    }

    public function testWithoutStartParam()
    {
        $response = $this->json('GET', route('data', ['type' => 'trend']) . '?metric=semaphore_cpu_usage' . '&end=' . time());

        $response->assertStatus(422);
    }

    public function testWithoutEndParam()
    {
        $response = $this->json('GET', route('data', ['type' => 'trend']) . '?metric=semaphore_cpu_usage' . '&start=' . time());

        $response->assertStatus(422);
    }

    public function testWithValidFilter()
    {
        $this->withoutExceptionHandling();

        $response = $this->json('GET', route('data', ['type' => 'trend']) . '?metric=semaphore_cpu_usage&start=' . time() . '&end=' . time());

        $response->assertStatus(200);
    }
}
