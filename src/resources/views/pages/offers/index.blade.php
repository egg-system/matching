@extends('templates.app')
@push('script')
<link href="{{ asset('/css/pages/offers/index.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="offers-index-page">
    <div class="bg">
        <h2>エントリー／オファー一覧</h2>
        @foreach($offers as $offer)
        <history-item
          transition="{{$user->isGym ? '/trainers/' . $offer->trainer->user_id : '/gyms/' . $offer->gym->user_id}}"
          photo="{{$user->isGym ? $offer->trainer->photo_url : $offer->gym->photo_url}}"
          name="{{$user->isGym ? $offer->trainerName : $offer->gymName}}"
          comment="{{$offer->created_at->format('Y/m/d')}}に{{$offer->state->name}}{{$user->user_type === $offer->state->transition_user_type ? 'しました' : 'が届きました'}}"
        ></history-item>
        @endforeach
    </div><!-- .bg -->
</div><!-- .wrapper -->
@endsection
