@extends('trainer.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">トレーナー編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('trainer.update', [$trainer->id]) }}">
                        @method('PUT')
                        @csrf
                        
                        @include('trainer._commonForm', ['type' => 'edit'])

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話番号</label>
                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror"
                                    name="tel" value="{{ $trainer->tel ?? old('tel') }}" autocomplete="tel" autofocus>
                                @error('tel')
                                <span class="text-danger" style="color:red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pr_comment" class="col-md-4 col-form-label text-md-right">PRコメント</label>
                            <div class="col-md-6">
                                <textarea id="pr_comment" class="form-control @error('pr_comment') is-invalid @enderror"
                                    name="pr_comment" value="{{ $trainer->pr_comment ?? old('pr_comment') }}" autocomplete="pr_comment"
                                    autofocus>{{ $trainer->pr_comment ?? old('pr_comment') }}</textarea>
                                @error('pr_comment')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="occupations" class="col-md-4 col-form-label text-md-right">種類</label>
                            <div class="col-md-6">
                                <select name="occupation_id" class="form-control" id="occupations">
                                    <option value=""></option>
                                    @foreach ($occupations as $occupation)
                                    <option value="{{ $occupation->id }}"
                                        {{ (isset($matchingCondition->occupation_id) ? (string)$matchingCondition->occupation_id : old('occupation_id')) === (string)$occupation->id ? 'selected' : '' }}>
                                        {{ $occupation->name }}</option>
                                    @endforeach
                                </select>
                                @error('occupation_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">希望単価</label>
                            <div class="col-md-3">
                                <input id="price" type="number"
                                    class="form-control @error('price.min') is-invalid @enderror" name="price[min]"
                                    value="{{ isset($matchingCondition->price['min']) ? $matchingCondition->price['min'] : old('price.min') }}" autocomplete="price" autofocus>
                                @error('price.min')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <span>~</span>
                            <div class="col-md-3">
                                <input id="price" type="number"
                                    class="form-control @error('price.max') is-invalid @enderror" name="price[max]"
                                    value="{{ isset($matchingCondition->price['max']) ? $matchingCondition->price['max'] : old('price.max') }}" autocomplete="price" autofocus>

                                @error('price.max')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="work_time" class="col-md-4 col-form-label text-md-right">希望曜日</label>
                            <div class="col-md-3">
                                <select name="work_time[week]" class="form-control" id="work_time">
                                    <option></option>
                                    @foreach (trans('search.day_of_week') as $day_of_week)
                                    <option value="{{ $day_of_week }}"
                                        {{ (isset($matchingCondition->work_time['week']) ? $matchingCondition->work_time['week'] : old('work_time.week')) === $day_of_week ? 'selected' : '' }}>
                                        {{ $day_of_week }}</option>
                                    @endforeach
                                </select>
                                @error('work_time.week')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="work_time" class="col-md-4 col-form-label text-md-right">希望時間帯</label>
                            <div class="col-md-3">
                                <input id="work_time" type="time"
                                    class="form-control @error('work_time.time') is-invalid @enderror"
                                    name="work_time[time]" value="{{ isset($matchingCondition->work_time['time']) ? $matchingCondition->work_time['time'] : old('work_time.time') }}" autocomplete="work_time"
                                    autofocus>
                                @error('work_time.time')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
