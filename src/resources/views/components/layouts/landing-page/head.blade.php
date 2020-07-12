@extends('components.layouts.common.head')

@section('head')
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/landing-page.css') }}" rel="stylesheet">
@endsection
