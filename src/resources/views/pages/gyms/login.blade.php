@extends('templates.app')

@section('content')
    @include('components.common._loginForm', ['isGymOwner' => true])
@endsection
