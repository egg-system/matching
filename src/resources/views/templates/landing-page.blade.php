@extends('templates.base')

@section('head')
    @include('components.layouts.landing-page.head')
@endsection

@section('body')
    <div class="flex-grow-1">
        @include('components.layouts.landing-page.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
@endsection
