@extends('templates.users.login')

@section('page-title')
    アカウント作成ページ
@endsection

@section('content')
    <div class="userInfo">
        <form
            action="{{ route('trainers.register') }}"
            method="post"
            class="pw-form-container"
        >
            @csrf
            <div>
                <label for="email_address">
                    メールアドレス
                </label>
                <input id="email_address" type="email" name='email'>
            </div>
            <div>
              <input type="submit" value="次へ">
            </div>
        </form>
    </div>
@endsection
