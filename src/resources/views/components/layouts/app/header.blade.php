@php
$user = \Auth::user();

// TODO: #117 変数の注入方法を検討する
$headerMenu = [
    [
        'image' => '/images/app/home-icon',
        'url' => route($user->homeRouteName),
        'isActive' => \Route::is('home.*'),
    ],
    [
        'image' => '/images/app/message-icon',
        'url' => route('offers.index'),
        'isActive' => \Route::is('offers.*'),
    ]
];

$profileMenus = [
    [
        'name' =>  $user->isGym ? '基本情報編集' : 'プロフィール編集',
        'url' => route('settings.profile.edit'),
        'isShown' => !$user->isGym,
    ],
]
@endphp

<app-header
    :header-menus='@json($headerMenu)'
    :profile-menus='@json($profileMenus)'
    :logout-url='@json(route('settings.logout'))'
    profile-image="/images/app/setting-icon"
></app-header>
