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
                    <a href="{{url('/user/viewstudent')}}">List Student</a>
                    <br>
                    <br>

                    <p>Menu Management</p>
                    <a href="{{url('/user/orderfood')}}">Menu Selection</a>
                    <br>
                    <a href="{{url('/user/vieworder')}}">List Orders</a>
                    <br>
                    <br>

                    <p>Transaction Management</p>
                    <a href="{{url('/user/listtrans')}}">List Transactions</a>
                    <br>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
