<?php

return [
    
    //you can configure your prefered cache driver
    'cache_driver' => 'redis',

    'drivers' => [
        'redis' => [
            'prefix' => 'rate-limiter'
        ],
        'database' => [
            'table' => 'rate_limit_logs',
        ],
    ]
];