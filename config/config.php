<?php

declare(strict_types=1);

return [
    'default' => 'default',
    'accounts' => [
        'default' => [
            'user' => env('ESPUTNIK_USER', ''),
            'password' => env('ESPUTNIK_PASSWORD', ''),
            'book' => env('ESPUTNIK_BOOK'),
        ],
    ],
];
