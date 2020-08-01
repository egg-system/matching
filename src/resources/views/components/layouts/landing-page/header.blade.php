@php
// TODO: #117 メニュー用の変数の管理方法を検討する
// TODO: #155 グローバルメニューの内容をFIXする
$headerMenus = [
    [
        'name' => 'トレーナーログイン',
        'url' => route('login.view', ['userType' => 'trainer']),
    ],
    [
        'name' => 'ジムオーナーログイン',
        'url' => route('login.view', ['userType' => 'gym']),
    ]
]
@endphp

<landing-page-header
    :menus='@json($headerMenus)'
></landing-page-header>
