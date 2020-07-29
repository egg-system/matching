@extends('templates.landing-page')

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

@section('head')
@parent
<link href="{{ mix('css/pages/commercial-transactions.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="commercial-transactions">
    <div class="title">特定商取引法に基づく表記</div>
    <table class="transactions-info">
        <tr>
            <th>販売業者</th>
            <td>株式会社エッグシステム</td>
        </tr>
        <tr>
            <th>代表者</th>
            <td>高橋翼</td>
        </tr>
        <tr>
            <th>サイト</th>
            <td>
                BorderlessGYM（ボーダーレスジム）<br>
                <a href="/">https://borderless-gym.com/</a>
            </td>
        </tr>
        <tr>
            <th>所在地</th>
            <td>
                〒160-0023<br>
                東京都新宿区西新宿8-11-10 星野ビル3階
            </td>
        </tr>
        <tr>
            <th>商品の名称</th>
            <td>サービス利用料課金</td>
        </tr>
        <tr>
            <th>販売価格</th>
            <td>
                ジム掲載初期費用：30,000円（税抜）<br>
                システム利用料　：契約金額の15%
            </td>
        </tr>
        <tr>
            <th>連絡先</th>
            <td>info@eggsystem.co.jp　／　03-6262-9734</td>
        </tr>
        <tr>
            <th>支払方法と支払期限</th>
            <td>
                クレジットカード、銀行振込<br>
                ※支払期限につきましては取引によって異なります
            </td>
        </tr>
        <tr>
            <th>引渡し時期</th>
            <td>即時</td>
        </tr>
        <tr>
            <th>返品・交換について</th>
            <td>確定後の取引は原則として返品・交換は不可能です</td>
        </tr>
    </table>
</div>
<landing-page-footer
    :menus='@json($footerMenus)'
></landing-page-footer>
@endsection
