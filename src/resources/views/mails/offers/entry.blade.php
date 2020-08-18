いつも BorderlessGYM（ボーダーレスジム） をご利用いただきまして、ありがとうございます。<br />
<br />
@if ($sendToUser->isGym)<br />
{{$offer->trainerName}}さんがあなたのジムにエントリーしました！<br />
<br />
<a href="{{url('trainers/' . $offer->trainerLogin->user_id)}}">トレーナーの詳細情報を確認する</a><br />
<br />
<br />
トレーナーと個別やり取りをできるように準備しますので、今しばらくお待ちください。<br />
<br />
個別のやり取りを通じて、トレーナーを採用したいかどうかを確認しましょう。<br />
興味があれば、トレーナーと個別面談をしましょう。<br />
@else
下記ジムへのエントリーを受け付けました！<br />
------------------------------------------------<br />
{{$offer->gymName}}<br />
<a href="{{url('gyms/' . $offer->gymLogin->user_id)}}">※ジム詳細情報はこちらから</a><br />
------------------------------------------------<br />
<br />
ジムと個別やり取りをできるように準備しますので、今しばらくお待ちください。<br />
<br />
<br />
自己紹介ページを充実させて、ジムからのオファー数を高めましょう。<br />
働きたい日数などもジムへアピールできます！<br />
<br />
◆こちらから編集できます<br />
@php
    $editUrl = route('settings.profile.edit');
@endphp
<a href="{{ $editUrl }}">{{ $editUrl }}</a><br />
@endif
<br />
気になる点やご要望などありましたら、お気軽に borderless-gym@eggsystem.co.jp までお知らせください。<br />
<br />
今後ともBorderlessGYMをよろしくお願いいたします。<br />
@include('mails/footer')