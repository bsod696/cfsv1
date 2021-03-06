@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Edit Parent Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    @foreach( $updata as $u)
                    <!-- <form action="{{ route('admin.submit.deleteparent') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gtr-50 gtr-uniform">
                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Remove Parent Detail') }}" class="button special small" onclick="return confirm('Are you sure you want to Remove this Parent?');"></input>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form> -->

                    <form method="POST" action="{{ route('admin.submit.editparent') }}">
                        @csrf

                        <div class="row gtr-50 gtr-uniform">

                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $u->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ ucfirst($u->fullname) }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $u->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="phonenum" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>
                                <input id="phonenum" type="number" class="form-control{{ $errors->has('phonenum') ? ' is-invalid' : '' }}" name="phonenum" value="{{ $u->phonenum }}" required autofocus>

                                @if ($errors->has('phonenum'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The mobile number must be more than 10 characters long, should only contain numeric character</strong>
                                    </span>
                                @endif
                            </div>
                        
                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Update') }}"></input>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </form>
                    @endforeach
</div>
@endsection
