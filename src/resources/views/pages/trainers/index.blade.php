@extends('templates.app')

@section('content')
<h2>トレーナー一覧</h2>
<div class="card">
    <div class="card-header">
        検索
    </div>
    <div class="card-body">
        <form action="#" method="GET">
            <div class="form-group row">
                <label for="area" class="col-md-2 col-form-label text-md-right">地域</label>

                <div class="col-md-2">
                    <select name="area_id" id="area" class="form-control">
                        <option></option>
                        @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>

                    @error('area_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="price" class="col-md-2 col-form-label text-md-right">希望単価</label>
                <div class="col-md-2">
                    <input id="price" type="number" class="form-control @error('price.min') is-invalid @enderror"
                        name="price[min]" value="{{ old('price.min') }}" autocomplete="price" autofocus>
                    @error('price.min')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <span>~</span>
                <div class="col-md-2">
                    <input id="price" type="number" class="form-control @error('price.max') is-invalid @enderror"
                        name="price[max]" value="{{ old('price.max') }}" autocomplete="price" autofocus>

                    @error('price.max')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="work_time" class="col-md-2 col-form-label text-md-right">希望曜日</label>
                <div class="col-md-2">
                    <input id="work_time" type="text" class="form-control @error('work_time.week') is-invalid @enderror"
                        name="work_time[week]" value="{{ old('work_time.week') }}" autocomplete="work_time" autofocus>
                    @error('work_time.week')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <label for="work_time" class="col-md-2 col-form-label text-md-right">希望時間帯</label>
                <div class="col-md-2">
                    <input id="work_time" type="time" class="form-control @error('work_time.time') is-invalid @enderror"
                        name="work_time[time]" value="{{ old('work_time.time') }}" autocomplete="work_time" autofocus>
                    @error('work_time.time')
                    <span class="text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <button class="btn btn-info" type="submit">検索</button>
            </div>
        </form>
    </div>
</div>
<table class="table text-center">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">種類</th>
            <th scope="col">場所／エリア</th>
            <th scope="col">単価</th>
            <th scope="col">働ける曜日や時間帯</th>
            <th scope="col">オファー状況</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($conditions as $condition)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ optional($condition->area)->name }}</td>
            <td>{{ implode(',',$condition->price ?? []) }}</td>
            <td>{{ implode(',',$condition->work_time ?? []) }}</td>
            <td>
                {{-- トレーナにオファーしていない場合ボタン表示 --}}
                @php
                    $offer = $offers->whereStrict(
                        'offer_to_id',
                        optional($condition->user->login)->id
                    )->first();
                @endphp
                @if(!$offer)
                    @include('components.gyms.offerModalForm', compact('condition'))
                @else
                    {{ optional($offer->state)->name }}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
