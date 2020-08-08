@extends('templates.users.register')

@section('content')
<form method="POST" action="{{ URL::signedRoute('trainers.store', ['id' => request()->id ]) }}">
    @csrf
    <?php
        // componentのpropsに合わせて変換
        $formattedOccupations = collect($occupations)->map(function ($occupation) {
            $img = '';
            if ($occupation->name === 'フィットネス') {
                $img = '/images/users-register/fitness_icon.jpg';
            } elseif ($occupation->name === 'ジム') {
                $img = '/images/users-register/gym_icon2.jpg';
            } elseif ($occupation->name === 'パーソナル') {
                $img = '/images/users-register/personal_trainer_icon.jpg';
            }
            return collect([ 'name' => $occupation->name, 'value' => $occupation->id, 'img' => $img ]);
        });
        $formattedAreas = collect($areas)->map(function ($area) {
            return collect([ 'name' => $area->name, 'value' => $area->id ]);
        });
        $formattedAreas->prepend(collect([ 'name' => '', 'value' => '' ]));
    ?>
    <users-register :occupations="{{ json_encode($formattedOccupations) }}" :areas="{{ json_encode($formattedAreas) }}" />
</form>
@endsection
