@extends('gymowner.layouts.app')

@section('content')
<h2>トレーナー一覧</h2>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">種類</th>
            <th scope="col">場所／エリア</th>
            <th scope="col">単価</th>
            <th scope="col">働ける曜日や時間帯</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($conditions as $condition)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ optional($condition->occupation)->name }}</td>
            <td>{{ optional($condition->area)->name }}</td>
            <td>{{ implode(',',$condition->price ?? []) }}</td>
            <td>{{ implode(',',$condition->work_time ?? []) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
