@extends('layouts.app')

@include('layouts.head')
@include('layouts.header')
@include('layouts.script')

@section('content')
    @include('common._loginForm', ['is_gym_owner' => true])
@endsection
