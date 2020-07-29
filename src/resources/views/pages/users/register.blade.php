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
    ?>
    <users-register :occupations="{{ json_encode($formattedOccupations) }}" />
</form>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">トレーナー登録</div>

                <div class="card-body">
                    <form method="POST" action="{{ URL::signedRoute('trainers.store', ['id' => request()->id ]) }}">
                        @csrf
                        @include('components.common._form', ['type' => 'register'])
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    value="{{ old('password') }}" required autocomplete="password" autofocus>

                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">パスワード（確認用）</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <span for="agree" class="col-md-4 col-form-label text-md-right">
                                <a href="{{ route('serviceTerm') }}" target="_blank">利用規約</a>の同意</span>
                            <div class="col-md-3">
                                <input id="agree" type="checkbox"
                                    class="custom-checkbox @error('agree') is-invalid @enderror" name="agree" value="1"
                                    autofocus {{ old('agree') ? 'checked' : '' }}>
                                @error('agree')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    トレーナー登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
