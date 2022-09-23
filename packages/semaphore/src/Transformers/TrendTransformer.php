<?php

namespace Semaphore\Transformers;

use Semaphore\DataTransferObjects\TrendDTO;
use Semaphore\DataTransferObjects\ValueTimeDTO;

class TrendTransformer implements TransformerInterface
{
    /** @return TrendDTO[] */
    public function transform($data): array
    {
        $result = $data['data']['result'];
        $trendsByTimestamp = [];
        $trendsByLabel = [];
        $timestamps = [];

        foreach ($result as $item) {
            $trendsByLabelItem = [
                'label_extension' => 'pid=' . $item['metric']['pid'],
                'label' => $item['metric']['process'],
            ];

            foreach ($item['values'] as $itemValue) {
                $total = isset($trendsByTimestamp[$itemValue[0]]) ? $trendsByTimestamp[$itemValue[0]]['total'] : 0;
                $values = isset($trendsByTimestamp[$itemValue[0]]) ? $trendsByTimestamp[$itemValue[0]]['values'] : [];

                $values[] = [
                    'label_extension' => 'pid=' . $item['metric']['pid'],
                    'label' => $item['metric']['process'],
                    'value' => $itemValue[1],
                ];

                $trendsByTimestamp[$itemValue[0]] = [
                    'timestamp' => $itemValue[0],
                    'datetime' => date('Y-m-d H:i:s', $itemValue[0]),
                    'total' => $total + $itemValue[1],
                    'values' => $values,
                ];

                $trendsByLabelItem['values'][$itemValue[0]] = [
                    'datetime' => date('Y-m-d H:i:s', $itemValue[0]),
                    'timestamp' => $itemValue[0],
                    'value' => $itemValue[1],
                ];
            }

            $trendsByLabel[] = $trendsByLabelItem;


        }

        //dd($labels);

        ksort($trendsByTimestamp);

        return [
            'values' => array_values($trendsByLabel),
            'totals' => array_values($trendsByTimestamp),
        ];
    }
}
