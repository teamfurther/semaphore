<?php

namespace App\CheckTypes;

use App\Actions\Trend\GetTrendFromPrometheusAction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class Trend extends CheckType
{
    private GetTrendFromPrometheusAction $getTrendFromPrometheusAction;

    public function __construct()
    {
        $this->getTrendFromPrometheusAction = resolve(GetTrendFromPrometheusAction::class);
    }

    public function response(Request $request): JsonResponse
    {
        $data = $this->getTrendFromPrometheusAction->execute();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
