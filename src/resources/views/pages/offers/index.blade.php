@extends('templates.app')
@push('script')
    <link href="{{ asset('/css/pages/offers/index.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="offers-index-page">
        <div class="bg">
            <h2>エントリー／オファー一覧</h2>
            @forelse($offers as $offer)
                @php

                    $trainsition = $user->isGym ? "/trainers/{$offer->trainerLogin->user_id}"
                        : "/gyms/{$offer->gymLogin->user_id}";
                    $photo = $user->isGym ? '/images/trainers/trainer-icon.png'
                        : $offer->gymLogin->user->job->main_image_url;

                    $comment = $offer->created_at->format('Y/m/d');
                    $comment = "{$comment}に{$offer->state->name}";

                    $trainsionUserType = $offer->state->transition_user_type;
                    $doesLoginUserOffer = $user->user_type === $trainsionUserType;
                    $comment = $doesLoginUserOffer ? "{$comment}しました" : "{$comment}が届きました";


                @endphp
                <history-item
                    transition='{{ $trainsition }}'
                    photo="{{ $photo }}"
                    name="{{ $user->isGym ? $offer->trainerName : $offer->gymName }}"
                    comment='{{ $comment }}'
                ></history-item>
            @empty
                <p>オファーはまだありません。</p>
            @endforelse
        </div>
    </div>
@endsection
