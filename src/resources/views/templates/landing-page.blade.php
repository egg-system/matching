@extends('templates.base')

@section('head')
    @include('components.layouts.landing-page.head')
@endsection

@section('body')
    <div>
        @include('components.layouts.landing-page.header')

        <v-main>
            @yield('content')
        </v-main>
    </div>
</body>
@endsection
