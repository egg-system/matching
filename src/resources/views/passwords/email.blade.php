@extends('templates.users.login')

@section('page-title')
    パスワード再設定ページ
@endsection

@section('content')
    <div class="userInfo">
        <form
            action="{{ route('password.email') }}"
            method="post"
            class="pw-form-container"
        >
            @csrf
            <div>
                <label for="email_address">メールアドレス</label>
                <input id="email_address" name="email" type="email">
                <input type="hidden" name="user_type" value="{{ $userModel }}">
                @if ($errors->any)
                    @foreach ($errors->all() as $error)
                        <div class="login-error">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            <div>
                <input type="submit" value="パスワード再設定メールを送信する">
            </div>
        </form>
    </div>
@endsection
