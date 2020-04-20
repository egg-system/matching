@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">トレーナー登録</div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ route('trainer.register',['id' => request()->id,'signature' => request()->signature]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">氏名</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話番号</label>
                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror"
                                    name="tel" value="{{ old('tel') }}" autocomplete="tel" autofocus>
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
                                    name="pr_comment" value="{{ old('pr_comment') }}" autocomplete="pr_comment"
                                    autofocus></textarea>
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
                                    <option></option>
                                    @foreach ($occupations as $occupation)
                                    <option value="{{ $occupation->id }}"
                                        {{ old('occupation_id') === $occupation->id ? 'selected' :''}}>
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
                            <label for="areas" class="col-md-4 col-form-label text-md-right">場所／エリア</label>
                            <div class="col-md-6">
                                <select name="area_id" class="form-control" id="areas">
                                    <option></option>
                                    @foreach ($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('area_id') === $area->id ? 'selected' :''}}>
                                        {{ $area->name }}</option>
                                    @endforeach
                                </select>
                                @error('area_id')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hope_price" class="col-md-4 col-form-label text-md-right">希望単価</label>
                            <div class="col-md-3">
                                <input id="hope_price" type="number"
                                    class="form-control @error('hope_price.min') is-invalid @enderror"
                                    name="hope_price['min']" value="{{ old('hope_price.min') }}"
                                    autocomplete="hope_price" autofocus>
                                @error('hope_price.min')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <span>~</span>
                            <div class="col-md-3">
                                <input id="hope_price" type="number"
                                    class="form-control @error('hope_price.max') is-invalid @enderror"
                                    name="hope_price['max']" value="{{ old('hope_price.max') }}"
                                    autocomplete="hope_price" autofocus>

                                @error('hope_price.max')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hope_work_time" class="col-md-4 col-form-label text-md-right">希望曜日</label>
                            <div class="col-md-3">
                                <input id="hope_work_time" type="text"
                                    class="form-control @error('hope_work_time.week') is-invalid @enderror"
                                    name="hope_work_time['week']" value="{{ old('hope_work_time.week') }}"
                                    autocomplete="hope_work_time" autofocus>
                                @error('hope_work_time.week')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hope_work_time" class="col-md-4 col-form-label text-md-right">希望時間帯</label>
                            <div class="col-md-3">
                                <input id="hope_work_time" type="time"
                                    class="form-control @error('hope_work_time.time') is-invalid @enderror"
                                    name="hope_work_time['time']" value="{{ old('hope_work_time.time') }}"
                                    autocomplete="hope_work_time" autofocus>
                                @error('hope_work_time.time')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <span for="agree" class="col-md-4 col-form-label text-md-right">
                                <a href="{{ route('serviceRule') }}" target="_blank">利用規約</a>の同意</span>
                            <div class="col-md-3">
                                <input id="agree" type="checkbox"
                                    class="custom-checkbox @error('agree') is-invalid @enderror" name="agree" value="1"
                                    autofocus>
                                @error('agree')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    トレーナー登録
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
