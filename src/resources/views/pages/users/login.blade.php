@extends('templates.landing-page')

@section('content')
    @php
        $userType = \Request::route()->parameter('userType');
        $isGym = $userType === 'gym';
    @endphp

    @include('components.common._loginForm', ['isGym' => $isGym])
@endsection
