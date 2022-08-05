<?php

namespace Semaphore\Widgets;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Semaphore\Actions\Eol\GetEolFromPrometheusAction;

class Eol extends Widget
{
    private GetEolFromPrometheusAction $getEolFromPrometheusAction;

    public function __construct()
    {
        $this->getEolFromPrometheusAction = resolve(GetEolFromPrometheusAction::class);
    }

    public function response(Request $request): JsonResponse
    {
        $data = $this->getEolFromPrometheusAction->execute($request);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
