@extends('trainer.layouts.app')

@section('content')
    @include('common._loginForm', ['is_gym_owner' => false])
@endsection
