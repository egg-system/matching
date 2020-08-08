@php
$profileUrl = route(\Auth::user()->homeRouteName);
$headerMenu = [
    [
        'icon' => 'mdi-card-account-details',
        'url' => $profileUrl,
    ],
    [
        'icon' => 'mdi-chat-processing',
        'url' => '',
    ],
    // [
    //     'icon' => 'mdi-bell',
    //     'url' => '',
    // ]
];

$profileMenu = [
    // [
    //     'icon' => 'cards-heart',
    //     'name' => '「いいね」一覧',
    //     'url' => '',
    // ]
    [
        'icon' => 'mdi-lock',
        'name' => 'パスワード変更',
        'url' => '',
    ],
    [
        'name' => 'ログアウト',
        'url' => route('logout'),
    ]
];
@endphp

<app-header
    :header-menus='@json($headerMenu)'
    :profile-menus='@json($profileMenu)'
    :profile-url='@json($profileUrl)'
></app-header>
