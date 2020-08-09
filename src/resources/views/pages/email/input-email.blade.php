@extends('templates.landing-page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col-12 col-md-9 mb-2 mb-md-0">
                            <input class="form-control form-control-lg" name="email" type="email"
                                placeholder="Enter your email...">
                        </div>
                        <div class="col-12 col-md-3">
                            <button class="btn btn-primary btn-block btn-lg" type="submit">{{ __('Register') }}</button>
                        </div>
                    </div>
                    @error('email')
                    <div class="form-row">
                        <div class="col-12 col-md-9 mb-2 mb-md-0" style="color:red">
                            <strong>{{ $message }}</strong>
                        </div>
                        <div class="col-12 col-md-3">
                        </div>
                    </div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
