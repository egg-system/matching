@extends('templates.app')

@push('styles')
    <link href="{{ mix('css/pages/gyms/show.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div id="jobVacancies">
        <div class="mv">
            <img src="{{ $gym->job->main_image_url }}" alt="ジム画像">
        </div>

        <div class="wrapper">
            <h1>{{ $gym->job->title }}</h1>
            <div class="company">{{ $gym->login->name }}</div>

        <div class="jobDetails">
            <h2>求人の内容</h2>
            <ul>
                <li>
                    <dl>
                        <dt>稼働日数</dt>
                        <dd>週{{ $gym->matchingCondition->weekly_worktime }}日</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>業務内容</dt>
                        <dd>{{ $gym->job->job_content }}</dd>
                    </dl>
                </li>
                <li>
                    <dl>
                        <dt>特徴</dt>
                        <dd>
                        @foreach ($gym->features as $feature)
                            ・{{ $feature }}<br />
                        @endforeach
                        </dd>
                    </dl>
                </li>
                @if($gym->job->requirements_number)
                    <li>
                        <dl>
                            <dt>募集人数</dt>
                            <dd>{{ $gym->job->requirements_number }}名</dd>
                        </dl>
                    </li>
                @endif
            </ul>
        </div>

        <div class="gymDetail">
            @foreach ($gym->job->job_info as $jobDetail)
                <div class="gym">
                    <h2>{{ $jobDetail['title'] }}</h2>
                    @if(array_key_exists('image', $jobDetail))
                        <div class="kv">
                            <img src="{{ $jobDetail['image'] }}" alt="求人の詳細情報画像">
                        </div>
                    @endif
                    <div class="content">
                        @foreach(explode("\n", $jobDetail['description']) as $description)
                            <p>{{ $description }}</p>
                        @endforeach
                    </div>
                </div>      
            @endforeach
        

        <div class="seek">
            <h2>求める人物像</h2>
            <div class="content">
            <p>{{ nl2br($gym->job->requirements) }}</p>
            </div>
        </div>

        <div class="about">
            <h2>ジム概要</h2>
            <ul>
            <li>
                <dt>ジム名</dt>
                <dd>{{ $gym->login->name }}</dd>
            </li>
            <li>
                <dt>代表者氏名</dt>
                <dd>{{ $gym->presidentName }}</dd>
            </li>
            <li>
                <dt>場所</dt>
                <dd>{{ $gym->address }}</dd>
            </li>
            <li>
                <dt>従業員数</dt>
                <dd>{{ $gym->staffNumber }}</dd>
            </li>
            </ul>
        </div>
        </div>

    </div>
    </div>

    {{-- ジム詳細は公開しているため、ジム判定を追加している --}}
    @if(!\Auth::user()->isGym)
        <offer-btn
            label='エントリーする'
            route='{{ route('offers.store') }}'
            trainer-id="{{ \Auth::id() }}"
            gym-id="{{ $gym->login->id }}"
            offer-state-id="{{ \App\Models\OfferState::ENTRY }}"
            @if($gym->isSameArea(\Auth::user()->user))
                disabled
                hint='このジムにはエントリーできません'
            @elseif(\Auth::user()->doOffered($gym->login->id))
                disabled
                hint='すでにエントリー済みです'
            @endif
        ></offer-btn>
    @endif
@endsection
