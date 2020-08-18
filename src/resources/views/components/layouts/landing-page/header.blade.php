@php
// TODO: #117 メニュー用の変数の管理方法を検討する
$headerMenus = [
    [
        'name' => '無料で始める',
        'url' => route('inputEmail'),
    ],
    [
        'name' => 'ログイン',
        'url' => route('login.view', ['userType' => 'trainer']),
    ],
    [
        'name' => 'お問い合わせ',
        'url' => 'https://forms.gle/ETkFKttFfxLPM6DF6',
    ]
]
@endphp

<landing-page-header
    :menus='@json($headerMenus)'
></landing-page-header>
