@extends('templates.users.login')

@section('page-title')
    パスワード再設定ページ
@endsection

@section('content')
    <div class="userInfo">
      <form
        action="{{ route('password.update') }}"
        method="post"
        class="pw-form-container"
      >
        @csrf
        <div>
          <h2>新しいパスワードを入力してください</h2>
          <label for="password">新しいパスワード</label>
          <div class="passwordParent">
            <input type="password" name="password">
            <span class="field-icon">
              <i toggle="#password-field" class="toggle-password fas fa-eye"></i>
            </span>
            <input type="password" name="password_confirmation">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="user_type" value="{{ $userType }}">
            @if ($errors->any)
                @foreach ($errors->all() as $error)
                    <div class="login-error">{{ $error }}</div>
                @endforeach
            @endif
          </div>
        </div>
        <div>
          <input type="submit" value="パスワードの変更">
        </div>
      </form>
    </div>
@endsection