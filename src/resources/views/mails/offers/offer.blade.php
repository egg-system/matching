いつも BorderlessGYM（ボーダーレスジム） をご利用いただきまして、ありがとうございます。<br />
<br />
@if ($sendToUser->isGym)
下記トレーナーへのオファーを受け付けました！<br />
------------------------------------------------<br />
{{$offer->trainerName}}<br />
<a href="{{url('trainers/' . $offer->trainerLogin->user_id)}}">※トレーナー詳細情報はこちらから</a><br />
------------------------------------------------<br />
<br />
トレーナーと個別やり取りをできるように準備しますので、今しばらくお待ちください。<br />
<br />
求人情報ページを充実させて、トレーナーからのエントリー数を高めましょう。<br />
ジムの想いやコンセプトなどもトレーナーへアピールできます！<br />
<br />
◆こちらから編集できます<br />
@php
    $editUrl = route('settings.profile.edit');
@endphp
<a href="{{ $editUrl }}">{{ $editUrl }}</a><br />
@else
{{$offer->gymName}}があなたにオファーを出しました！<br />
<br />
<a href="{{url('gyms/' . $offer->gymLogin->user_id)}}">ジムの詳細情報を確認する</a><br />
<br />
<br />
ジムと個別やり取りをできるように準備しますので、今しばらくお待ちください。<br />
<br />
個別のやり取りを通じて、ジムで働いてみたいかどうかを確認しましょう。<br />
興味があれば、ジムと個別面談をしましょう。<br />
@endif
<br>
気になる点やご要望などありましたら、お気軽に borderless-gym@eggsystem.co.jp までお知らせください。<br
<br>
今後ともBorderlessGYMをよろしくお願いいたします。<br>
@include('mails/footer')