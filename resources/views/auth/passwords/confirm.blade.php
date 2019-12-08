@extends('layouts.master')

@section('content')
<header>
        <h2>{{ __('Confirm Password') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row gtr-50 gtr-uniform">
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li><input type="submit" value="{{ __('Confirm Password') }}"></input></li>
                                    @if (Route::has('password.request'))
                                    <li>
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
