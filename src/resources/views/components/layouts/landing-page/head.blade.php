@extends('components.layouts.common.head')

@section('head')
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link
        href="{{ mix(
            'css/landing-page.css'
        ) }}"
        rel="stylesheet"
    >
@endsection
