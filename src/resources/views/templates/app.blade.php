@extends('templates.base')

@section('head')
    @include('components.layouts.app.head')
@endsection

@section('body')
    <div class="app-page">
        @include('components.layouts.common.header')

        <v-main>
            @yield('content')
            @include('components.layouts.common.footer')
        </v-main>
    </div>
@endsection
