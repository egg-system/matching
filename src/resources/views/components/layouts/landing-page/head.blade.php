@extends('components.layouts.common.head')

@section('head')
    @include('components.layouts.common.head')
    <link
        href="{{ mix('css/landing-page.css') }}"
        rel="stylesheet"
    >
@endsection
