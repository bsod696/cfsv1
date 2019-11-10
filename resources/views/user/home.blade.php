@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Parent Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Student Management</p>
                    <a href="{{url('/user/storestudent')}}">Add Student</a>
                    <br>
                    <a href="{{url('/user/viewstudent')}}">View Student</a>
                    <br>
                    <br>

                    <p>Menu Management</p>
                    <a href="{{url('/user/orderfood')}}">Menu Selection</a>
                    <br>
                    <a href="{{url('/user/vieworder')}}">View Orders</a>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
