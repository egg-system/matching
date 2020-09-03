ボーダーレスジムからの通知です。<br />
ユーザーがマッチングしました。<br />
<br />
--------------------------------<br />
○ マッチングデータ<br />
・オファー / エントリー<br />
　- {{ $offer->state->name }}<br />
・時刻<br />
　- {{ $offer->created_at }}<br />
<br />
@foreach ($offer->getSendMailUsers() as $sendUser)
○ {{ $sendUser->isGym ? 'ジム情報' : 'トレーナー情報' }}<br />
・ユーザー名<br />
　- {{ $sendUser->name }}<br />
・メールアドレス<br />
　- {{ $sendUser->email }}<br />
<br />
@endforeach
--------------------------------<br />
<br />
