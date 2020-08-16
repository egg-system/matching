@extends('templates.users.login')

@section('page-title')
    パスワード再設定ページ
@endsection

@section('content')
    <div class="userInfo">
        <p>
            入力していただいたメールアドレスにメールを送信いたしましたので、新しいパスワードを設定してください。<br>
            <br>
            10分以上経過してもメールが届かない場合は、お手数をおかけいたしますが、下記より再度メールアドレスの入力をお願いいたします。
        </p>

        <div class="sentEmailAgainBtn">
            <a href="{{ route('password.request', [
                'userType' => $userType,
            ]) }}" class="bgGray">
                もう一度試す
            </a>
            <a href="{{ route('login.view', [
                'userType' => $userType,
            ]) }}">
                ログイン画面にもどる
            </a>
        </div>
    </div>
@endsection
