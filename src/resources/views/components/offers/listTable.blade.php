<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>ジム</th>
            <th>トレーナー</th>
            <th>オファー状況</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($offers as $offer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $offer->gym->name }}</td>
            <td>{{ $offer->trainer->name }}</td>
            <td>{{ $offer->state->name }}</td>
            <td>
                <a href="{{ route('offers.show', $offer->id) }}" class="btn btn-success">詳細</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
