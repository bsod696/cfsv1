@extends('layouts.user-app')

@section('content')
<!-- <section id="main" class="container"> -->
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

                    <section class="box special">
                        <header class="major">
                            <h2>Parent Homepage</h2>
                            <p>Before ordering meals for your children, parents must make sure their children were added to this system and setup a default credit/debit card to pay for the orders.</p>
                        </header>
                        <!-- <span class="image featured"><img src="{{ asset('images/pic01.jpg') }}" alt="" /></span> -->
                    </section>

                    <div class="row">
                        <div class="col-6 col-12-narrower">

                            <section class="box special">
                                <span class="image featured"><img src="{{ asset('images/asia-life.jpg') }}" height="200" alt="" /></span>
                                <h3>Manage you Children</h3>
                                <p>Add or update details of your children.</p>
                                <ul class="actions special">
                                    <li><a href="{{url('/user/storestudent')}}" class="button alt">Add Student</a></li>
                                    <li><a href="{{url('/user/viewstudent')}}" class="button alt">List Student</a></li>
                                </ul>
                            </section>

                        </div>

                        <div class="col-6 col-12-narrower">

                            <section class="box special">
                                <span class="image featured"><img src="{{ asset('images/shared meal.jfif') }}" height="200" alt="" /></span>
                                <h3>Manage their Meal</h3>
                                <p>Choose from our delicious healthy meals.</p>
                                <ul class="actions special">
                                    <li><a href="{{url('/user/menuselect')}}" class="button alt">Menu Selection</a></li>
                                    <li><a href="{{url('/user/vieworder')}}" class="button alt">Your Orders</a></li>
                                </ul>
                            </section>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-6 col-12-narrower">

                            <section class="box special">
                                <span class="image featured"><img src="{{ asset('images/credit-card-debit-card-23_04_605248.jpg') }}" height="200" alt="" /></span>
                                <h3>Manage your Payments</h3>
                                <p>Add credit/debit card to proceed payment.</p>
                                <ul class="actions special">
                                    <li><a href="{{url('/user/storepayment')}}" class="button alt">Add Payment</a></li>
                                    <li><a href="{{url('/user/viewpayment')}}" class="button alt">Payment Details</a></li>
                                </ul>
                            </section>

                        </div>
                        <div class="col-6 col-12-narrower">

                            <section class="box special">
                                <span class="image featured"><img src="{{ asset('images/credit-card-transaction-fee-statement.jpg') }}" height="200" alt="" /></span>
                                <h3>Manage your Transactions</h3>
                                <p>View all transactions from your orders.</p>
                                <ul class="actions special">
                                    <li><a href="{{url('/user/listtrans')}}" class="button alt">List Transactions</a></li>
                                </ul>
                            </section>

                        </div>
                    </div>
<!-- </section> -->
@endsection
