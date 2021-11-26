<?php

namespace Semaphore\Widgets;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Semaphore\Actions\Gauge\GetGaugeFromPrometheusAction;

class Gauge extends Widget
{
    private GetGaugeFromPrometheusAction $getGaugeFromPrometheusAction;

    public function __construct()
    {
        $this->getGaugeFromPrometheusAction = resolve(GetGaugeFromPrometheusAction::class);
    }

    public function response(Request $request): JsonResponse
    {
        $data = $this->getGaugeFromPrometheusAction->execute($request);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
