<?php

namespace Semaphore\Actions\Alerts;

use Semaphore\Actions\ActionInterface;

class GetValueDynamicallyAction implements ActionInterface
{
    public function execute(...$args)
    {
        /** @var array{class: string, methods: array{name: string, arguments: string[]}} $array */
        $array = $args[0];
        $object = null;

        if (array_key_exists('class', $array)) {
            $object = new $array['class'];

            if (array_key_exists('methods', $array)) {
                foreach ($array['methods'] as $methodItem) {
                    $method = $methodItem['name'];
                    $arguments = array_key_exists('arguments', $methodItem) ? $methodItem['arguments'] : [];
                    $object = $object->$method(...$arguments);
                }
            }
        }

        return $object;
    }
}
