@extends('templates.users.login')

@php
    $userType = \Request::route()->parameter('userType');
    $isGym = $userType === 'gym';
@endphp

@section('page-title')
    {{ $isGym ? 'ジムオーナー用 ログインページ' : 'ログインページ' }}
@endsection

@section('content')
    <div class='userInfo'>
        <form
            action="{{ route('login.post') }}"
            method='post'
            class='pw-form-container'
        >
            @csrf
            <input	
                type='hidden'	
                name='user_type'	
                value="{{ $isGym ? \App\Models\Gym::class : \App\Models\Trainer::class }}"
            >
            <div>
                <label for='email_address'>メールアドレス</label>
                <input id='email_address' type='email' name='email'>
            </div>
            <div>
                <label for='password'>パスワード</label>
                <div class='passwordParent'>
                    <input type='password' name='password'>
                    @if ($errors->any)
                        @foreach ($errors->all() as $error)
                            <div class="login-error">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div>
                <input type='submit' value='ログイン'>
            </div>
        </form>
    </div>

    <div class='forgot'>
        パスワードを忘れた方は
        <a href="{{ route('password.request', [
            'userType' => $isGym ? 'gym' : 'trainer'
        ]) }}">こちら</a>
    </div>
@endsection
