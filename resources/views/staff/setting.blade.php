@extends('layouts.staff-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Setting') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!empty($message))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif
                    <p>Personal Details</p>
                    <a href="{{url('/staff/editstaff')}}">Edit</a>
                    <br>
                    <br>

                    <p>Security</p>
                    <a href="{{url('/staff/storeaccount')}}">Change Password</a>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
