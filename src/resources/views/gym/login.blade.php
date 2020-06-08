@extends('layouts.app')

@section('content')
    @include('common._loginForm', ['isGymOwner' => true])
@endsection
