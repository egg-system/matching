@extends('templates.users.register')

@section('content')
    <form
        method="POST"
        action="{{ URL::signedRoute('trainers.store', [
            'id' => request()->id
        ]) }}"
    >
        @csrf
        <users-register
            :occupations="{{ json_encode($occupations) }}"
            :areas="{{ json_encode($areas) }}"
        ></users-register>
    </form>
@endsection
