@php
$user = \Auth::user();
$headerMenu = [
    [
        'icon' => 'mdi-home',
        'url' => route($user->homeRouteName),
    ],
    [
        'icon' => 'mdi-chat-processing',
        'url' => route('offers.index'),
    ],
    // [
    //     'icon' => 'mdi-bell',
    //     'url' => '',
    // ]
];

$profileMenu = [
    [
        'name' =>  $user->isGym ? '基本情報編集' : 'プロフィール編集',
        'url' => '',
    ],
    [
        'name' =>  '求人情報編集',
        'url' => '',
        'isShown' => $user->isGym,
    ],
    // [
    //     'icon' => 'cards-heart',
    //     'name' => '「いいね」一覧',
    //     'url' => '',
    // ]
    [
        'name' => 'パスワード変更',
        'url' => '',
    ]
];
@endphp

<app-header
    :header-menus='@json($headerMenu)'
    :profile-menus='@json($profileMenu)'
    :logout-url='@json(route('logout'))'
></app-header>
