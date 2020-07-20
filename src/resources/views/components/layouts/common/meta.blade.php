@hasSection('title')
    <title>@yield('title') | {{ config('app.name') }}</title>
@else
    <title>
        {{ config('app.name', 'Laravel') }} | トレーナーのための複業・副業マッチングプラットフォーム
    </title>
@endif

@hasSection('description')
    <meta name="description" content="@yield('description')">
@else
    <meta name="description" content="
        BorderlessGYMは、ジムとトレーナーが出会うための複業マッチングプラットフォームです。
        トレーナーの複業・副業を推進し、会社・組織の境目をなくしていくことで、 
        より柔軟な働き方を実現し、経済的・精神的な自由を得るためのサービスです。
    ">
@endif
