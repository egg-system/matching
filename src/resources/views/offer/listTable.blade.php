<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>From</th>
            <th>To</th>
            <th>オファー状況</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($offers as $offer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $offer->fromUser->user->name }}</td>
            <td>{{ $offer->toUser->user->name }}</td>
            <td>{{ $offer->state->name }}</td>
            <td>
                <a href="{{ route('offer.show', $offer->id) }}" class="btn btn-success">詳細</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
