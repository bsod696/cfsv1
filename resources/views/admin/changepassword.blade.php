@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Change Password') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.submit.password') }}">
                        @csrf

                        <div class="row gtr-50 gtr-uniform">

                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ Auth::guard('admin')->user()->id }}" readonly>
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="cpassword" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
                                <input id="cpassword" type="password" class="form-control{{ $errors->has('cpassword') ? ' is-invalid' : '' }}" name="cpassword" required>

                                @if ($errors->has('cpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cpassword') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric or new password not match with confirm password</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Change Password') }}"></input>
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
