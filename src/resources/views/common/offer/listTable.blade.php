<table class="table table-bordered">
    <thead>
        <tr>
            <th>No.</th>
            <th>From</th>
            <th>To</th>
            <th>オファー状況</th>
        </tr>
    </thead>
    <tbody>
        @foreach($offers as $offer)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $offer->gym_name }}</td>
            <td>{{ $offer->trainer_name }}</td>
            <td>{{ $offer->state_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
