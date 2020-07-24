@extends('templates.base')
@extends('components.layouts.common.head')

@section('head')
    <link href="{{ asset('/css/pages/users/register.css') }}" rel="stylesheet">
@endsection

@section('body')
    <div class="users-register-page">
        <v-main>
            @yield('content')
        </v-main>
    </div>
</body>
@endsection
