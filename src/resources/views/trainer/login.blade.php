@extends('trainer.layouts.app')

@section('content')
    @include('common._login_form', ['is_gym_owner' => false])
@endsection
