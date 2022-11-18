<?php

namespace Semaphore\Widgets;

use Illuminate\Http\Request;
use Semaphore\Actions\Value\GetValueFromPrometheusAction;

class Value extends Widget
{
    private GetValueFromPrometheusAction $getValueFromPrometheusAction;

    public function __construct()
    {
        $this->getValueFromPrometheusAction = resolve(GetValueFromPrometheusAction::class);
    }

    public function response(Request $request)
    {
        $data = $this->getValueFromPrometheusAction->execute($request);

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
