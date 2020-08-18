@extends('templates.app')
@push('script')
<link href="{{ asset('/css/pages/users/edit.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="users-edit-page">
    <div class="header">
        <h1>{{ $user->isGym ? 'ジムオーナー編集' : 'トレーナー編集' }}</h1>
    </div>
    
    <form method="POST" action="{{ route('settings.profile.update') }}">
        <div class="body">
            @method('PUT')
            @csrf

            <input-form
                label="氏名"
                name="name"
                id="name"
                type="text"
                value="{{ $user->login->name }}"
                autocomplete="name"
                autofocus
                error="{{ $errors->first('name') }}"
            ></input-form>

            <input-form
                label="ニックネーム"
                name="display_name"
                id="name"
                type="text"
                value="{{ $user->display_name }}"
                autocomplete="name"
                autofocus
                error="{{ $errors->first('display_name') }}"
            ></input-form>

            @php
                $selectedIds = $matchingCondition->occupations->pluck('id');
            @endphp
            <div class="checkbox-form-container">
                <label class="form-label">職種</label>
                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="パーソナル"
                        id="occupations.personal"
                        name="occupation_ids[]"
                        value="{{ \App\Models\Occupation::PERSONAL }}"
                        checked="{{ $selectedIds->contains(\App\Models\Occupation::PERSONAL) }}"
                    ></checkbox-form>
                </div>

                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="ジム"
                        id="occupations.gym"
                        name="occupation_ids[]"
                        value="{{ \App\Models\Occupation::GYM }}"
                        checked="{{ $selectedIds->contains(\App\Models\Occupation::GYM) }}"
                    ></checkbox-form>
                </div>

                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="フィットネス"
                        id="occupations.fitness"
                        name="occupation_ids[]"
                        value="{{ \App\Models\Occupation::FITNESS }}"
                        checked="{{ $selectedIds->contains(\App\Models\Occupation::FITNESS) }}"
                    ></checkbox-form>
                </div>
            </div>

            <?php
                // componentのpropsに合わせて変換
                $formattedAreas = collect($areas)->map(function ($area) {
                    return collect([
                        'name' => $area->name,
                        'value' => $area->id,
                    ]);
                });
                $formattedAreas->prepend(collect([
                    'name' => '',
                    'value' => '',
                ]));
            ?>
            <select-form
                label="現在の勤務地エリア"
                sublabel="エリア"
                name="now_work_area_id"
                id="now_work_area_id"
                :options="{{ json_encode($formattedAreas) }}"
                selected="{{ $user->now_work_area_id }}"
                error="{{ $errors->first('now_work_area_id') }}"
            ></select-form>

            @php
                // 1日から7日までの稼働を並べる
                $workTimeOptions = collect(range(1, 7))->map(function ($workTimeOption) {
                    return [
                        'name' => "1週間辺り {$workTimeOption} 日の稼働",
                        'value' => $workTimeOption,
                    ];
                });
                $workTimeOptions->prepend(collect([ 'name' => '', 'value' => '' ]));
            @endphp
            <select-form
                label="1週間辺りの稼働"
                name="weekly_worktime"
                id="work_time_week"
                :options="{{ json_encode($workTimeOptions) }}"
                selected="{{ $matchingCondition->weekly_worktime }}"
                error="{{ $errors->first('weekly_worktime') }}"
            ></select-form>

            <select-form
                label="希望エリア"
                sublabel="希望エリア"
                id="area_id"
                name="area_id"
                :options="{{ json_encode($formattedAreas) }}"
                selected="{{ $matchingCondition->area_id }}"
                error="{{ $errors->first('area_id') }}"
            ></select-form>

            <div class="checkbox-form-container">
                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="平日勤務可能"
                        id="can_work_weekday"
                        name="can_work_weekday"
                        checked="{{ $matchingCondition->can_work_weekday }}"
                    ></checkbox-form>
                </div>

                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="休日勤務可能"
                        id="can_work_holiday"
                        name="can_work_holiday"
                        checked="{{ $matchingCondition->can_work_holiday }}"
                    ></checkbox-form>
                </div>

                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="ジムや案件に合わせて調整可"
                        id="can_adjust"
                        name="can_adjust"
                        checked="{{ $matchingCondition->can_adjust }}"
                    ></checkbox-form>
                </div>

                <div class="checkbox-form-container__form">
                    <checkbox-form
                        label="転職を検討中"
                        id="is_considering_change_job"
                        name="is_considering_change_job"
                        checked="{{ $user->is_considering_change_job }}"
                    ></checkbox-form>
                </div>
            </div>
        </div>

        <label class="form-label">経歴</label>

        {{-- 文字列の状態で渡す ※ inputの値は文字列になるため --}}
        <careers-editor
            :careers="{{ $user->careers }}"
        ></careers-editor>
    </form>
</div>
@endsection
