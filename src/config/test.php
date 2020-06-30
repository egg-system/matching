<?php

return [
    'seeds' => [
        'default' => [
            'email' => [
                'trainer' => 'test-trainer@test.co.jp',
                'gym' => 'test-gym@test.co.jp',
            ],
            'password' => env('TEST_SEEDER_DEFAULT_PASSWORD', 'password'),
        ],
    ],
];
