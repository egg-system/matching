@extends('components.layouts.common.head')

@section('head')
    <link
        href="{{ asset(
            'css/landing-page.css',
            app()->isProduction()
        ) }}"
        rel="stylesheet"
    >
@endsection
