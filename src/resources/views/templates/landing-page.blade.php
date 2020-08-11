@extends('templates.base')

@section('head')
    @include('components.layouts.landing-page.head')
@endsection

@section('body')
    <div class="landing-page">
        @include('components.layouts.common.header')

        <v-main>
            @yield('content')
            @include('components.layouts.common.footer')
        </v-main>
    </div>
</body>
@endsection
