@extends('layouts.app')

@include('layouts.head')
@include('layouts.header')
@include('layouts.script')

@section('content')
    @include('common._loginForm', ['isGymOwner' => true])
@endsection
