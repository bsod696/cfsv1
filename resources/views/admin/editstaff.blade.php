@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Staff') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach( $updata as $u)
                    <form action="{{ route('admin.submit.deleteparent') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />
                        <button type="submit" name="submit" class="btn btn-primary">{{ __('Delete Staff') }}</button>
                    </form>

                    <form method="POST" action="{{ route('admin.submit.editstaff') }}">
                        @csrf

                        <div class="form-group row">
                            <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $u->username }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ ucfirst($u->fullname) }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                             <div class="col-md-6">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $u->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="phonenum" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="phonenum" type="text" class="form-control{{ $errors->has('phonenum') ? ' is-invalid' : '' }}" name="phonenum" value="{{ $u->phonenum }}" required autofocus>

                                @if ($errors->has('phonenum'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>The mobile number must be more than 10 characters long, should only contain numeric character</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
