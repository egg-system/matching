@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <a href="{{ route('trainer.offer.index') }}">一覧へ戻る</a>
            <div class="card">
                <div class="card-header">
                    From : {{ $offer->fromUser->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">本文 : </h5>
                    <p class="card-text">
                        {!! nl2br(e($offer->message)) !!}
                    </p>
                    <div class="d-flex flex-row-reverse">
                        @if($offer->offer_state === App\Models\OfferState::UNREPLY)
                        <form action="{{ route('trainer.offer.update', $offer->id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <label for="radio-1">承諾</label>
                            <input id="radio-1" type="radio" name="offer_state"
                                value="{{ App\Models\OfferState::ACCEPT }}">
                            <label for="radio-2">辞退</label>
                            <input id="radio-2" type="radio" name="offer_state"
                                value="{{ App\Models\OfferState::REFUSE }}">
                            <button class="btn-primary" type="submit">送信</button>
                        </form>
                        @else
                        返答済み
                        @endif
                    </div>
                </div>
                <div class="card-footer text-muted">
                    {{ $offer->created_at }}
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

</div>
@endsection
