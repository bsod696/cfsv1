@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Student Management</p>
                    <!-- <a href="{{url('/admin/storestudent')}}">Add Student</a>
                    <br> -->
                    <a href="{{url('/admin/viewstudent')}}">List Student</a>
                    <br>
                    <br>

                    <p>Payment Management</p>
                    <!-- <a href="{{url('/admin/storepayment')}}">Add Payment</a>
                    <br> -->
                    <a href="{{url('/admin/viewpayment')}}">View Payment Details</a>
                    <br>
                    <br>

                    <p>Menu Management</p>
                    <a href="{{url('/admin/storemenu')}}">Add Menu</a>
                    <br>
                    <a href="{{url('/admin/menuselect')}}">List Menu</a>
                    <br>
                    <br>

                    <p>Order Management</p>
                    <a href="{{url('/admin/vieworder')}}">List Orders</a>
                    <br>
                    <br>

                    <p>Transaction Management</p>
                    <a href="{{url('/admin/listtrans')}}">List Transactions</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
