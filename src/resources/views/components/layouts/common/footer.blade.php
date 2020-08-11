@php
// TODO: #117 メニュー用の変数の管理方法を検討する
$footerMenus = [
    [
        'name' => '運営会社',
        'url' => 'https://eggsystem.co.jp/'
    ],
    [
        'name' => 'お問い合わせ',
        'url' => 'https://forms.gle/ETkFKttFfxLPM6DF6'
    ],
    [
        'name' => '利用規約',
        'url' => '/service-term'
    ],
    [
        'name' => '個人情報保護方針',
        'url' => '/privacy-policy'
    ],
    [
        'name' => '特定商取引法に基づく表記',
        'url' => '/commercial-transactions'
    ]
];
@endphp

<landing-page-footer
    :menus='@json($footerMenus)'
></landing-page-footer>
