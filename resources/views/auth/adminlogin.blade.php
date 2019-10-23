@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row.aln-center">
        <div class="col-12-small">
                    <h3>Admin Sign In</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row gtr-50">
                            <div class="col-12-small">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12-small">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                 @enderror
                            </div>

                            <div class="col-12 col-12-small">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="col-12-small">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                            <div class="col-12-small">
                                <a class="btn btn-link" href="{{ route('user.register') }}">
                                    Don't Have Account? Click Here to Sign Up
                                </a>
                            </div>
                    </form>
        </div>
    </div>
</div>
@endsection
