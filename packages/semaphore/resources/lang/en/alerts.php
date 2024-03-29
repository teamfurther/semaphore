<?php

return [
    'current' => [
        'gt' => "*%1\$s*\n`%2\$s` value of `%3\$s%%` has exceeded the maximum value of `%5\$s%%`.",
        'lt' => "*%1\$s*\n`%2\$s` value of `%3\$s%%` has fallen below the minimum value of `%4\$s%%`.",
        'interval' => "*%1\$s*\n`%2\$s` value of `%3\$s%%` was outside the allowed interval of `%4\$s%% - %5\$s%%`.",
    ],
    'period' => [
        'gt' => "*%1\$s*\n`%2\$s` value of `%3\$s%%` has exceeded the maximum value of `%5\$s%%` for the past `%6\$s`.",
        'lt' => "*%1\$s*\n`%2\$s` value of `%3\$s%%` has fallen below the minimum value of `%4\$s%%` for the past `%6\$s`.",
        'interval' => "*%1\$s*\n`%2\$s` value of `%3\$s%%` was outside the allowed interval of `%4\$s%% - %5\$s%%` for the past `%6\$s`.",
    ],
];