@extends('layouts.staff-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Staff Dashboard</div>

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

                    <p>Redemption</p>
                    <a href="{{url('/staff/redeem')}}">Scanner</a>
                    <br>
                    <br>

                    <p>Payment Management</p>
                    <a href="{{url('/staff/viewaccount')}}">View Account Details</a>
                    <br>
                    <br>

                    <p>Menu Management</p>
                    <a href="{{url('/staff/viewmenu')}}">List Menu</a>
                    <br>
                    <br>

                    <p>Order Management</p>
                    <a href="{{url('/staff/listorder')}}">List Orders</a>
                    <br>
                    <a href="{{url('/staff/ordersummary')}}">Orders Summary</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
