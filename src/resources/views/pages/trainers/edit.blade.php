@extends('templates.app')
@section('pageCss')
<link href="{{ asset('/css/pages/trainers/edit.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="page">
    <div class="header">
        <h1>プロフィール編集</h1>
    </div>

    <form method="POST" action="{{ route('trainers.update', [$trainer->id]) }}">
        <div class="header__aside">
            <button type="submit">保存</button>
        </div>

        <div class="body">
            @method('PUT')
            @csrf

            <form-wrapper
                label="氏名"
                name="name"
                error="{{ $errors->first('name') }}"
            >
                <input-form
                    name="name"
                    id="name"
                    type="text"
                    value="{{ optional(Auth::user())->name ?? old('name') }}"
                    autocomplete="name"
                    autofocus
                    error="{{ $errors->first('name') }}"
                ></input-form>
            </form-wrapper>

            <?php
                // componentのpropsに合わせて変換
                $formattedOccupations = array(array('name' => '-- 選択してください --', 'value' => ''));
                foreach ($occupations as $occupation) {
                    $obj["name"] = $occupation->name;
                    $obj["value"] = $occupation->id;
                    array_push($formattedOccupations, $obj);
                }
            ?>
            <form-wrapper
                label="業種"
                name="occupation_id"
                subtext="業種"
                error="{{ $errors->first('occupation_id') }}"
            >
                <select-form
                    name="occupation_id"
                    id="occupation"
                    :options="{{ json_encode($formattedOccupations) }}"
                    selected="{{ isset($matchingCondition->occupation_id) ? (string)$matchingCondition->occupation_id : old('occupation_id') }}"
                    error="{{ $errors->first('occupation_id') }}"
                ></select-form>
            </form-wrapper>

            <?php
                // componentのpropsに合わせて変換
                $formattedAreas = array(array('name' => '', 'value' => ''));
                foreach ($areas as $area) {
                    $obj["name"] = $area->name;
                    $obj["value"] = $area->id;
                    array_push($formattedAreas, $obj);
                }
            ?>
            <form-wrapper
                label="現在の勤務地エリア"
                name="areas"
                subtext="エリア"
                error="{{ $errors->first('area_id') }}"
            >
                <select-form
                    name="area_id"
                    id="area"
                    :options="{{ json_encode($formattedAreas) }}"
                    selected="{{ isset($matchingCondition->area_id) ? (string)$matchingCondition->area_id : old('area_id') }}"
                    error="{{ $errors->first('area_id') }}"
                ></select-form>
            </form-wrapper>

            <form-wrapper
                label="電話番号"
                name="tel"
                error="{{ $errors->first('tel') }}"
            >
                <input-form
                    name="tel"
                    id="tel"
                    type="tel"
                    value="{{ $trainer->tel ?? old('tel') }}"
                    autocomplete="tel"
                    error="{{ $errors->first('tel') }}"
                ></input-form>
            </form-wrapper>

            <form-wrapper
                label="自己紹介"
                name="pr_comment"
                error="{{ $errors->first('pr_comment') }}"
            >
                <text-area-form
                    name="pr_comment"
                    id="pr_comment"
                    value="{{ $trainer->pr_comment ?? old('pr_comment') }}"
                    placeholder="自己紹介を入れて企業にアピールしよう"
                    error="{{ $errors->first('pr_comment') }}"
                ></text-area-form>
            </form-wrapper>

            <form-wrapper
                label="希望単価"
                name="price"
                type="range"
                error="{{ !empty($errors->first('price.min')) ? $errors->first('price.min') : (!empty($errors->first('price.max')) ? $errors->first('price.max') : '') }}"
            >
                <template v-slot:from>
                    <input-form
                        name="price[min]"
                        id="price"
                        type="number"
                        value="{{ isset($matchingCondition->price['min']) ? $matchingCondition->price['min'] : old('price.min') }}"
                        error="{{ $errors->first('price.min') }}"
                    ></input-form>
                </template>
                <template v-slot:to>
                    <input-form
                        name="price[max]"
                        id="price"
                        type="number"
                        value="{{ isset($matchingCondition->price['max']) ? $matchingCondition->price['max'] : old('price.max') }}"
                        error="{{ $errors->first('price.max') }}"
                    ></input-form>
                </template>
            </form-wrapper>

            <?php
                // componentのpropsに合わせて変換
                $formattedDayOfWeek = array(array('name' => '', 'value' => ''));
                $dayOfWeek = trans('search.day_of_week');
                foreach ($dayOfWeek as $item) {
                    $obj["name"] = $item;
                    $obj["value"] = $item;
                    array_push($formattedDayOfWeek, $obj);
                }
            ?>
            <form-wrapper
                label="希望曜日"
                name="work_time"
                error="{{ $errors->first('work_time.week') }}"
            >
                <select-form
                    name="work_time[week]"
                    id="work_time"
                    :options="{{ json_encode($formattedDayOfWeek) }}"
                    selected="{{ isset($matchingCondition->work_time['week']) ? $matchingCondition->work_time['week'] : old('work_time.week') }}"
                    error="{{ $errors->first('work_time.week') }}"
                ></select-form>
            </form-wrapper>

            <form-wrapper
                label="希望時間帯"
                name="work_time"
                error="{{ $errors->first('work_time.time') }}"
            >
                <input-form
                    name="work_time[time]"
                    id="work_time"
                    type="time"
                    value="{{ isset($matchingCondition->work_time['time']) ? $matchingCondition->work_time['time'] : old('work_time.time') }}"
                    error="{{ $errors->first('work_time.time') }}"
                ></input-form>
            </form-wrapper>
        </div>
    </form>
</div>
@endsection
