@extends('templates.app')

@push('styles')
    <link href="{{ mix('css/pages/trainers/show.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div id="trainerDetail">
        <div class="wrapper">
            <div class="trainer">
                <h1>{{ $trainer->display_name }}</h1>
                <div class="job">
                    {{ $trainer->matchingCondition->occupations->first()->name }}
                    @if(isset($trainer->careers))
                        / {{ $trainer->lastCareerName }}
                    @endif
                </div>
            </div>

            @if($trainer->sortedCareers->isNotEmpty())
                <div class="career">
                    <h2>経歴</h2>
                    @foreach ($trainer->sortedCareers as $career)
                        <div class="careerDetail">
                            <h3>{{ $career['gym_name'] }}</h3>
                            @if($career['in_office'])
                                <div class="date">
                                    {{ $career['start_at'] }} - 在職中
                                </div>
                            @else
                                <div class="date">
                                    {{ $career['start_at'] }} - {{ $career['end_at'] }}
                                </div>
                            @endif
                            <p>{{ $career['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="workStyle">
                <h2>希望する働き方</h2>
                <div class="workStyleDetail">
                    <ul>
                        <li>
                            <dl>
                                <dt>稼働可能日数</dt>
                                <dd>
                                    @if($trainer->matchingCondition->weekly_worktime)
                                        {{ $trainer->matchingCondition->weekly_worktime }}日<br>
                                    @endif
                                    @foreach ($trainer->features as $feature)
                                        {{ $feature }}<br />
                                    @endforeach
                                </dd>
                            </dl>
                        </li>
                        @if($trainer->matchingCondition->area)
                            <li>
                                <dl>
                                    <dt>希望エリア</dt>
                                    <dd>{{ $trainer->matchingCondition->area->name }}</dd>
                                </dl>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <offer-btn
        label='オファーする'
        route='{{ route('offers.store') }}'
        trainer-id="{{ $trainer->login->id }}"
        gym-id="{{ \Auth::id() }}"
        offer-state-id="{{ \App\Models\OfferState::OFFER }}"
        @if(\Auth::user()->doOffered($trainer->login->id))
            disabled
            hint='すでにオファー済みです'
        @endif
    ></offer-btn>
@endsection
