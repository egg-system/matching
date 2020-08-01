@extends('templates.app')

@section('content')
    @include('components.common._loginForm', ['isGym' => $isGym])
@endsection
