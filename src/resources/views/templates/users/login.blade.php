@extends('templates.base')

@section('head')
    @include('components.layouts.users.login.head')
@endsection

@section('body')
  <div id="userLogin">
    <div class="wrapper">
      <div class="logo">
        <img src="/images/logo-msg.png" alt="borderlessGYM">
        <div>@yield('page-title')</div>
      </div>

      @yield('content')
    </div>
  </div>

  <div class="footer">
    <div class="terms">
      <ul>
        <li><a href="/service-term" target="_blank">利用規約</a></li>
        <li><a href="/privacy-policy" target="_blank">個人情報保護方針</a></li>
      </ul>
    </div>
    &copy; 2020 EGG SYSTEM, Inc.
  </div>
@endsection