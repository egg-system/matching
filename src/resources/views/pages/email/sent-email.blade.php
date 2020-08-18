@extends('templates.users.login')

@section('page-title')
    アカウント作成ページ
@endsection

@section('content')
    <div class="userInfo">
        <p>
            入力していただいたメールアドレスに確認用メールをお送りいたしました。<br>
            メール内にある確認用URLのクリックをお願いいたします。
        </p>
    </div>
@endsection
