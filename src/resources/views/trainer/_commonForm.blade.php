<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">氏名</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
            name="name" value="{{ $type !== 'register' ? (optional(Auth::user())->name ?? old('name')) : '' }}" required autocomplete="name" autofocus>

        @error('name')
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
            <option value="">-- 選択してください --</option>
            @foreach ($areas as $area)
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
    <label for="areas" class="col-md-4 col-form-label text-md-right">種別</label>
    <div class="col-md-6">
        <select name="occupation_id" class="form-control" id="occupation">
            <option value="">-- 選択してください --</option>
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
