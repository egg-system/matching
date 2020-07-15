@extends('templates.app')

@section('content')
    @include('components.common._loginForm', ['isGymOwner' => $isGymOwner])
@endsection
