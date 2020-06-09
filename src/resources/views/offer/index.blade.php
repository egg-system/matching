@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10"></div>
        <div class="col-2">
            <form method="GET" action="#">
                <select class="form-control" class="w-100" name="offer_state" onchange="submit(this.form)">
                    @foreach ($states as $state)
                    <option {{ old('offer_state',request('offer_state')) == $state->id ? 'selected' : '' }}
                        value="{{ $state->id }}">{{ $state->name }}</option>
                    @endforeach
                </select>
                <select class="form-control" class="w-100" name="type" onchange="submit(this.form)">
                    <option value="0">送信したオファー</option>
                    <option value="1">受信したオファー</option>
                </select>
            </form>
        </div>
    </div>

    @include('offer.listTable')
</div>
@endsection
