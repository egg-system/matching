<?php

return [
    'seeds' => [
        'default' => [
            'email' => 'test@test.co.jp',
            'password' => env('TEST_SEEDER_DEFAULT_PASSWORD', 'password'),
        ],
    ],
];
