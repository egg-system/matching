@extends('templates.base')

@section('head')
    @include('components.layouts.users.register.head')
@endsection

@section('body')
    <div class="users-register-page">
        <v-main>
            @yield('content')
        </v-main>
    </div>
</body>
@endsection
