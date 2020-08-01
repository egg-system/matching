<?php
/**
 *  機能のリリース制御用のconfig。
 *  is_enableがtureの場合は、リリース済みとみなす。
 */
return [
    'login' => [
        'is_enabled' => env('IS_RELEASE_LOGIN', false),
        'back_to' => 'top'
    ]
];
