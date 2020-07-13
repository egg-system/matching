@extends('templates.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @can('trainer')
                <div class="card-header">トレーナー編集</div>
                @elsecan('gym')
                <div class="card-header">ジムオーナー編集</div>
                @endcan
                <div class="card-body">
                    @can('trainer')
                    <form method="POST" action="{{ route('trainers.update', [$user->id]) }}">
                    @elsecan('gym')
                    <form method="POST" action="{{ route('gyms.update', $user->id) }}">
                    @endcan
                        @method('PUT')
                        @csrf

                        @include('components.common._form', ['type' => 'edit'])
                        @can('trainer')
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話番号</label>
                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror"
                                    name="tel" value="{{ $user->tel ?? old('tel') }}" autocomplete="tel" autofocus>
                                @error('tel')
                                <span class="text-danger" style="color:red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="areas" class="col-md-4 col-form-label text-md-right">場所／エリア</label>
                            <div class="col-md-6">
                                <select name="area_id" class="form-control" id="areas">
                                    <option value=""></option>
                                    @foreach ($areas ?? '' as $area)
                                    <option value="{{ $area->id }}"
                                        {{ (isset($matchingCondition->area_id) ? (string)$matchingCondition->area_id : old('area_id')) === (string)$area->id ? 'selected' : '' }}>
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
                            <label for="pr_comment" class="col-md-4 col-form-label text-md-right">PRコメント</label>
                            <div class="col-md-6">
                                <textarea id="pr_comment" class="form-control @error('pr_comment') is-invalid @enderror"
                                    name="pr_comment" value="{{ $user->pr_comment ?? old('pr_comment') }}" autocomplete="pr_comment"
                                    autofocus>{{ $user->pr_comment ?? old('pr_comment') }}</textarea>
                                @error('pr_comment')
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
                        @elsecan('gym')
                        <div class="form-group row">
                            <label for="president_name" class="col-md-4 col-form-label text-md-right">代表者名</label>
                            <div class="col-md-6">
                                <input class="form-control @error('president_name') is-invalid @enderror" type="text"
                                       name="president_name" id="president_name"
                                       value="{{ old('president_name',$user->president_name) }}"
                                       autocomplete="president_name" autofocus>
                                @error('president_name')
                                <span class="text-danger" style="color:red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">電話番号</label>
                            <div class="col-md-6">
                                <input id="tel" type="tel" class="form-control @error('tel') is-invalid @enderror"
                                       name="tel" value="{{ old('tel',$user->tel) }}" autocomplete="tel" autofocus>
                                @error('tel')
                                <span class="text-danger" style="color:red" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staff_count" class="col-md-4 col-form-label text-md-right">スタッフ数</label>
                            <div class="col-md-6">
                                <input class="form-control @error('staff_count') is-invalid @enderror" type="number"
                                       name="staff_count" id="staff_count"
                                       value="{{ old('staff_count',$user->staff_count) }}" autocomplete="staff_count"
                                       autofocus>
                                @error('staff_count')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_count" class="col-md-4 col-form-label text-md-right">顧客数</label>
                            <div class="col-md-6">
                                <input class="form-control @error('customer_count') is-invalid @enderror" type="number"
                                       name="customer_count" id="customer_count"
                                       value="{{ old('customer_count',$user->customer_count) }}"
                                       autocomplete="customer_count" autofocus>
                                @error('customer_count')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requirements" class="col-md-4 col-form-label text-md-right">募集人数</label>
                            <div class="col-md-3">
                                <input id="requirements" type="number"
                                       class="form-control @error('requirements.number') is-invalid @enderror"
                                       name="requirements[number]"
                                       value="{{ old('requirements.number',$user->requirements['number'] ?? '') }}"
                                       autocomplete="requirements" autofocus>
                                @error('requirements.number')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="requirements" class="col-md-4 col-form-label text-md-right">募集スキル</label>
                            <div class="col-md-3">
                                <input id="requirements" type="text"
                                       class="form-control @error('requirements.skill') is-invalid @enderror"
                                       name="requirements[skill]"
                                       value="{{ old('requirements.skill',$user->requirements['skill'] ?? '') }}"
                                       autocomplete="requirements" autofocus>
                                @error('requirements.skill')
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
                                       value="{{ isset($matchingCondition->price['min']) ? $matchingCondition->price['min'] : old('price.min') }}"
                                       autocomplete="price" autofocus>
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
                                       value="{{ isset($matchingCondition->price['max']) ? $matchingCondition->price['max'] : old('price.max') }}"
                                       autocomplete="price" autofocus>
            
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
                                       name="work_time[time]"
                                       value="{{ isset($matchingCondition->work_time['time']) ? $matchingCondition->work_time['time'] : old('work_time.time') }}"
                                       autocomplete="work_time" autofocus>
                                @error('work_time.time')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @endcan
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
