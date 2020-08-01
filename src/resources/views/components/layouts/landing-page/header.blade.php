@php
// TODO: #117 メニュー用の変数の管理方法を検討する
$headerMenus = [
    [
        'name' => 'トレーナーログイン',
        'url' => route('trainers.login'),
    ],
    [
        'name' => 'ジムオーナーログイン',
        'url' => route('gyms.login'),
    ]
]
@endphp

<landing-page-header
    :menus='@json($headerMenus)'
></landing-page-header>
