@component('mail::message')

** 以下の認証リンクをクリックしてください。 **

@component('mail::button', ['url' => $url])
本登録を行う
@endcomponent

---

※もしこのメールに覚えが無い場合は破棄してください。

---

@if (!empty($url))
「本登録を行う」ボタンをクリックできない場合は、下記のURLをコピーしてブラウザに貼り付けてください。
{{ $url }}
@endif

@endcomponent
