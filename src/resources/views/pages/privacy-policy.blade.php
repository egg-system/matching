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
<link href="{{ mix('css/pages/privacy-policy.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="privacy-policy">
    <div class="title">個人情報保護方針</div>
    <div class="article">
        <div class="article-title">第1条（総則）</div>
        <div>株式会社エッグシステム（以下「当社」といいます。）は、個人情報保護を企業における重要な社会的使命・責務と認識し、当社が保有するお客様の個人情報を適切に管理運用するために遵守するべき基本事項として本保護方針を定めます。</div>
        <div class="article-title">第2条（個人情報とは）</div>
        <div>当社において、個人情報とは、個人の識別に係る以下の情報をいいます。</div>
        <ul>
            <li>住所・氏名・電話番号・電子メールアドレス、クレジットカード情報、表示名、ニックネーム、IPアドレス等において、特定の個人を識別できる情報（他の情報と照合することができ、それにより特定の個人を識別することができることとなるものを含む。）</li>
            <li>当社の運営・提供するWebサービス「BorderlessGYM（ボーダーレスジム）」その他の当社のサービス（以下総称して「当社サービス」といいます。）において、お客様が、当社でご利用になったサービスの内容、ご利用日時、ご利用回数などのご利用内容及びご利用履歴に関する情報</li>
        </ul>
        <div class="article-title">第3条（個人情報の取得・収集について）</div>
        <div>当社は、以下の方法により、個人情報を取得させていただきます。</div>
        <ul>
            <li>
                当社のWebサービス等を通じて取得・収集させていただく方法<br>
                当社上で、自ら入力された個人情報を、当社は取得・収集させていただきます。
            </li>
            <li>
                電子メール、郵便、書面、電話等の手段により取得・収集させていただく方法<br>
                当社に対し、電子メール、郵便、書面、電話等の手段によって、ご提供いただいた個人情報を、当社は取得・収集させていただきます。
            </li>
        </ul>
        <div class="article-title">第4条（個人情報の取得・利用目的）</div>
        <div>当社において、当社は以下の目的のため、個人情報を適法かつ公正な手段で取得・利用させていただきます。当社は、お客様本人の同意がある場合を除き、以下の目的達成に必要な範囲を超えて、取得した個人情報を利用しません。</div>
        <ol>
            <li>当社サービスを提供するため</li>
            <li>当社サービスを安心・安全にご利用いただける環境整備のため</li>
            <li>当社サービスの運営・管理のため</li>
            <li>当社サービスに関するご案内、お問い合せ等への対応のため</li>
            <li>当社、その他当社サービスについての調査・データ集積、改善、研究開発のため</li>
            <li>当社がおすすめする商品・サービスなどのご案内を送信・送付するため</li>
            <li>当社とお客様の間での必要な連絡を行うため</li>
            <li>当社サービスに関する当社の規約、ポリシー等（以下「規約等」といいます。）に違反する行為に対する対応のため</li>
            <li>当社サービスに関する規約等の変更などを通知するため</li>
            <li>その他当社とお客様との間で同意した目的のため</li>
            <li>上記1から10に附随する目的のため</li>
        </ol>
        <div class="article-title">第5条（個人情報の利用）</div>
        <div>当社において、お客様の個人情報は、当社が取り扱う商品・サービス、アンケートのご案内・ご提供及びお仕事のご紹介、新商品の開発、利便性向上のために利用致します。利用する情報は、以下の方法によって取得したものを指します。</div>
        <ol>
            <li>お電話でお客様からの口頭からの取得</li>
            <li>電話帳データベース販売会社からの取得</li>
            <li>web上の資料請求画面からの取得</li>
            <li>当社への会員登録や案件履歴からの取得</li>
            <li>当社へ資料をご請求いただいた方からの取得</li>
            <li>アンケートにご回答いただいた方からの取得</li>
            <li>お客様等からのご紹介による取得</li>
        </ol>
        <div class="article-title">第6条（個人情報の管理）</div>
        <div>当社は、個人情報の滅失、き損、漏洩及び不正利用等を防止し、その安全管理を行うために必要な措置を講じ、個人情報の取扱責任者を設置し、個人情報を安全に管理します。また、当社は個人情報を利用目的の範囲内において、正確かつ最新の状態で管理するように努めます。</div>
        <div class="article-title">第7条（個人情報の第三者への提供・開示）</div>
        <div>当社は、以下のいずれかに該当する場合に限り、法令の範囲内で、個人情報を第三者に提供する場合があります。</div>
        <ul>
            <li>お客様本人の同意がある場合。</li>
            <li>公的機関等又はそれらの委託を受けた者より、開示請求を受領した場合。</li>
            <li>生命や財産に危機が生じ、緊急に開示する必要があり、当該お客様の同意を得るのが困難な場合。</li>
            <li>第三者に対し、当社の運営に必要な業務の一部もしくは一切を委託する場合又はビジネスの移管を行う場合。</li>
            <li>その他、個人情報の保護に関する法律（以下「個人情報保護法」といいます。）その他の法令で認められる場合。</li>
        </ul>
        <div class="article-title">第8条（個人情報の開示・訂正・利用停止）</div>
        <div>当社は、お客様から個人情報の開示、内容の訂正・追加・削除及び利用停止を求められた場合には適切にこれに対応します。但し、個人情報保護法その他の法令により、当社がこれらの義務を負わない場合は、この限りではありません。</div>
        <div class="article-title">第9条（クッキー（Cookie））</div>
        <div>
            当社は、当社サービスを通じてクッキーをお客様のコンピュータに送信することがあります。クッキーとは、ウェブサイトの利用履歴や入力内容等をお客様のコンピュータにファイルとして保存しておく仕組みであり、お客様がブラウザの設定でクッキーの送受信を許可している場合、当社はお客様のコンピュータに保存されたクッキーを取得し、収集した行動履歴と個人情報を紐付ける場合があります。当社は、お客様へのサービス利便性の向上、統計データの取得・分析等の目的でクッキーを利用します。<br>
            また当社では、最適な広告配信のために第三者企業の広告サービスを利用しています。当該サービスで利用するクッキーには、個人を特定・識別する情報は一切含まれず、効果的な広告配信及び広告配信用のアクセス解析の目的のみに使用し、その他の目的には使用しません。第三者企業における行動履歴情報の利用詳細確認や、第三者企業が送信するクッキーのオプトアウト（無効化）は、以下の第三者企業のページより行って下さい。
        </div>
        <div class="article-title">第10条（苦情処理）</div>
        <div>
            当社は個人情報に関する苦情に対しては、誠実に対応致します。<br>
            ご意見、ご質問、苦情のお申し出その他個人情報の取扱いに関するお問い合わせは、下記の窓口までお願いいたします。<br>
            <br>
            〒160-0023<br>
            東京都新宿区西新宿8-11-10 星野ビル3階<br>
            株式会社エッグシステム　個人情報担当<br>
            info@eggsystem.co.jp<br>
        </div>
        <div class="article-title">第11条（継続的改善）</div>
        <div>当社は、個人情報保護に関する取扱い、管理及び管理体制について継続的改善を行います。</div>
        <div class="article-title">第12条（改訂）</div>
        <div>本保護方針は、当社の判断によりお客様の同意なしに全部又は一部の改訂を行うことができるものとし、本保護方針改訂後にお客様が当社サービスを利用した場合には、当該改訂に同意したものとみなします。ただし、本保護方針の内容を大幅に改訂する場合については当社上においてお知らせいたします。</div>
    </div>
</div>
<landing-page-footer
    :menus='@json($footerMenus)'
></landing-page-footer>
@endsection
