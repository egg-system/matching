@component('mail::message')
# オファーのお知らせ

オファーされました！

@component('mail::button', ['url' => $url])
オファーの確認
@endcomponent

---

※もしこのメールに覚えが無い場合は破棄してください。

---
@endcomponent
