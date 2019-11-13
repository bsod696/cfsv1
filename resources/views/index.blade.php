@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Main Page</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h3>Get Started</h3>
                    <br>

                    <p>
                    	Parent
                    	<br>
	                    <a href="{{url('/user/login')}}">Sign In</a>
	                    <br>
	                    <a href="{{url('/user/register')}}">Sign Up</a>
	                    <br>
	                </p>
                    <br>
                    <p>
                    	Admin
                    	<br>
	                    <a href="{{url('/admin/login')}}">Sign In</a>
	                    <br>
	                    <!-- <a href="{{url('/admin/register')}}">Sign Up</a>
	                    <br> -->
	                </p>
                    <br>
                    <p>
                    	Staff
                    	<br>
	                    <a href="{{url('/staff/login')}}">Sign In</a>
	                    <br>
	                    <a href="{{url('/staff/register')}}">Sign Up</a>
	                    <br>
	                </p>
                    <br>

                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection