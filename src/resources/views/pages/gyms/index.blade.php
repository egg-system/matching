@extends('templates.app')

@push('styles')
    <link href="{{ mix('css/pages/gyms/index.css') }}" rel="stylesheet">
@endpush

@section('content')
<div id="gymList">
    <div class="wrapper">
        @foreach($matchingConditions as $matchingCondition)
            @php
                $gym = $matchingCondition->user;
                $job = $gym->job;
            @endphp

            <div class="item">
                <a href="{{ route('home.gyms.show', ['gym' => $gym->id]) }}">
                    <div class="gymImage">
                        <img src="{{ $job->imageUrl }}" alt="ジム画像">
                    </div>
                    <div class="itemDetail">
                        <h2>{{ $job->title }}</h2>
                        <div class="company">{{ $gym->login->name }}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
