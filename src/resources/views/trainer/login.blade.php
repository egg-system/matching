@extends('trainer.layouts.app')

@section('content')
    @include('common._loginForm', ['isGymOwner' => false])
@endsection
