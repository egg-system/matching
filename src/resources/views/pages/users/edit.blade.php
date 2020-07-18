@extends('templates.app')
@push('script')
<link href="{{ asset('/css/pages/users/edit.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="users-edit-page">
    @can('trainer')
    <div class="header">
        <h1>トレーナー編集</h1>
    </div>
    @elsecan('gym')
    <div class="header">
        <h1>ジムオーナー編集</h1>
    </div>
    @endcan
    
    @can('trainer')
    <form method="POST" action="{{ route('trainers.update', [$user->id]) }}">
    @elsecan('gym')
    <form method="POST" action="{{ route('gyms.update', $user->id) }}">
    @endcan

        <div class="header__aside">
            <button type="submit">保存</button>
        </div>

        <div class="body">
            @method('PUT')
            @csrf

            @can('trainer')
            <input-form
                label="氏名"
                name="name"
                id="name"
                type="text"
                value="{{ optional(Auth::user())->name ?? old('name') }}"
                autocomplete="name"
                autofocus
                error="{{ $errors->first('name') }}"
            ></input-form>

            <?php
                // componentのpropsに合わせて変換
                $formattedOccupations = collect($occupations)->map(function ($occupation) {
                    return collect([ 'name' => $occupation->name, 'value' => $occupation->id ]);
                });
                $formattedOccupations->prepend(collect([ 'name' => '-- 選択してください --', 'value' => '' ]));
            ?>
            <select-form
                label="業種"
                sublabel="業種"
                name="occupation_id"
                id="occupation"
                :options="{{ json_encode($formattedOccupations) }}"
                selected="{{ isset($matchingCondition->occupation_id) ? (string)$matchingCondition->occupation_id : old('occupation_id') }}"
                error="{{ $errors->first('occupation_id') }}"
            ></select-form>

            <?php
                // componentのpropsに合わせて変換
                $formattedAreas = collect($areas)->map(function ($area) {
                    return collect([ 'name' => $area->name, 'value' => $area->id ]);
                });
                $formattedAreas->prepend(collect([ 'name' => '', 'value' => '' ]));
            ?>
            <select-form
                label="現在の勤務地エリア"
                sublabel="エリア"
                name="area_id"
                id="area"
                :options="{{ json_encode($formattedAreas) }}"
                selected="{{ isset($matchingCondition->area_id) ? (string)$matchingCondition->area_id : old('area_id') }}"
                error="{{ $errors->first('area_id') }}"
            ></select-form>

            <input-form
                label="電話番号"
                name="tel"
                id="tel"
                type="tel"
                value="{{ $user->tel ?? old('tel') }}"
                autocomplete="tel"
                error="{{ $errors->first('tel') }}"
            ></input-form>
            
            <text-area-form
                label="自己紹介"
                name="pr_comment"
                id="pr_comment"
                value="{{ $user->pr_comment ?? old('pr_comment') }}"
                placeholder="自己紹介を入れて企業にアピールしよう"
                error="{{ $errors->first('pr_comment') }}"
            ></text-area-form>

            <range-input-form
                label="希望単価"
                name="price"
                from-id="price"
                from-name="price[min]"
                from-type="number"
                from-value="{{ isset($matchingCondition->price['min']) ? $matchingCondition->price['min'] : old('price.min') }}"
                from-error="{{ $errors->first('price.min') }}"
                to-name="price[max]"
                to-id="price"
                to-type="number"
                to-value="{{ isset($matchingCondition->price['max']) ? $matchingCondition->price['max'] : old('price.max') }}"
                to-error="{{ $errors->first('price.max') }}"
            ></range-input-form>

            <?php
                // componentのpropsに合わせて変換
                $dayOfWeek = trans('search.day_of_week');
                $formattedDayOfWeek = collect($dayOfWeek)->map(function ($item) {
                    return collect([ 'name' => $item, 'value' => $item ]);
                });
                $formattedDayOfWeek->prepend(collect([ 'name' => '', 'value' => '' ]));
            ?>
            <select-form
                label="希望曜日"
                name="work_time"
                form-name="work_time[week]"
                id="work_time"
                :options="{{ json_encode($formattedDayOfWeek) }}"
                selected="{{ isset($matchingCondition->work_time['week']) ? $matchingCondition->work_time['week'] : old('work_time.week') }}"
                error="{{ $errors->first('work_time.week') }}"
            ></select-form>

            <input-form
                label="希望時間帯"
                name="work_time"
                form-name="work_time[time]"
                id="work_time"
                type="time"
                value="{{ isset($matchingCondition->work_time['time']) ? $matchingCondition->work_time['time'] : old('work_time.time') }}"
                error="{{ $errors->first('work_time.time') }}"
            ></input-form>

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
        </div>
    </form>
</div>
@endsection
