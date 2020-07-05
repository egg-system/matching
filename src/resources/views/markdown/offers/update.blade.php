@component('mail::message')
# オファー返答のお知らせ

オファーに返答がありました！

@component('mail::button', ['url' => $url])
オファーの確認
@endcomponent

---

※もしこのメールに覚えが無い場合は破棄してください。

---
@endcomponent
