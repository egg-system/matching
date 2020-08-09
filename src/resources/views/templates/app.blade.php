@extends('templates.base')

@section('head')
    @include('components.layouts.app.head')
@endsection

@section('body')
    <div class="app-page">
        @include('components.layouts.app.header')

        <v-main>
            @yield('content')
        </v-main>
    </div>
@endsection
