@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Transaction Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <section class="box">
                    <div class="row gtr-50 gtr-uniform">
                        @foreach($trans as $t)
                        <div class="col-4">
                            <span class="image fit"><img src="{{ asset('images/logo.jfif') }}"></span>
                        </div>
                        <div class="col-8">
                            <h2>Canteen Food System</h2>
                        </div>
                        <div class="col-12">
                            <h3>This is your receipt.</h3>
                            <p>

                            @foreach($orders as $o)
                                <b> Menu Name: </b> {{ ucfirst($o->menuname) }} <br>
                                <b> Menu Quantity: </b> {{ $o->menuqty }} Units<br>
                                <b> Student ID : </b> {{ strtoupper($o->studentid) }}  <br>
                                <b> Student Name : </b> {{ ucfirst($o->studentname) }}  <br>
                            @endforeach

                                <b> Transaction Status : </b> {{ strtoupper($t->txstatus) }}  <br>
                                <b> Transaction Reference : </b> {{ $t->txreference }} <br> 
                                <b> Transaction Amount : </b> RM {{ $t->txamount }} <br>
                                <b> Transaction ID : </b> {{ $t->txid }} <br>
                        @endforeach
                        </p>
                        </div>
                    </div>

                    <p></p>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <p>
                                <b>Payment Information.</b><br>
                            @foreach($payments as $p)
                                <b> Issued To : </b> {{ ucfirst($p->fullname) }} <br>
                                <b> Card Number: </b> ************{{substr($p->cardnum,-4)}} <br>
                                <b> Card Merchant : </b> {{ strtoupper($p->cardtype) }}  <br>
                            @endforeach
                            </p>
                        </div>
                    </div>
                </section>
</div>
@endsection
