@extends('layouts.master')

@section('content')
<header>
        <h2>{{ __('Staff Sign Up') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                <form method="POST" action="{{ route('staff.register.submit') }}">
                    @csrf

                    <div class="row gtr-50 gtr-uniform">
                            <div class="col-6 col-12-mobilep">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <input id="fullname" type="text" class="form-control{{ $errors->has('fullname') ? ' is-invalid' : '' }}" name="fullname" value="{{ old('fullname') }}" required autofocus>

                                @if ($errors->has('fullname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fullname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                           </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="phonenum" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                <input id="phonenum" type="text" class="form-control{{ $errors->has('phonenum') ? ' is-invalid' : '' }}" name="phonenum" value="{{ old('phonenum') }}" required autofocus>

                                @if ($errors->has('phonenum'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The mobile number must be more than 10 characters long, should only contain numeric character</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric or password not match with confirm password</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Sign Up') }}"></input>
                                    </li>
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
