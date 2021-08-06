<?php

namespace App\Widgets;

use App\Actions\Trend\GetTrendFromPrometheusAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Trend extends Widget
{
    private GetTrendFromPrometheusAction $getTrendFromPrometheusAction;

    public function __construct()
    {
        $this->getTrendFromPrometheusAction = resolve(GetTrendFromPrometheusAction::class);
    }

    public function response(Request $request): JsonResponse
    {
        $data = $this->getTrendFromPrometheusAction->execute($request);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
