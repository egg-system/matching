いつも BorderlessGYM（ボーダーレスジム）をご利用いただきまして、ありがとうございます。<br />
<br />
ログインパスワードをリセットしました。<br />
パスワードの変更は下記URLよりお願いいたします。<br />
<br />
@php
$resetUrl = route('password.reset', [
    'userType' => $login->isGym ? 'gym' : 'trainer',
    'token' => $token,
])
@endphp

<a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
<br />
<br />
気になる点やご要望などありましたら、お気軽に borderless-gym@eggsystem.co.jp までお知らせください。<br />
今後ともBorderlessGYMをよろしくお願いいたします。<br />
@include('mails/footer')
