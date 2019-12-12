@extends('layouts.master')

@section('content')
<header>
        <h2>{{ __('Admin Sign In') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                   <form method="POST" action="{{ route('admin.login.submit') }}">
                        @csrf

                        <div class="row gtr-50 gtr-uniform">
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                           <!--  <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div> -->

                            <div class="col-12">
                                <ul class="actions special">
                                    <li><input type="submit" value="{{ __('Sign In') }}"></input></li>
                                    @if (Route::has('admin.password.request'))
                                    <li>
                                        <a class="btn btn-link" href="{{ route('admin.password.request') }}">
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
