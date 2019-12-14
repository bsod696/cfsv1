@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Transaction Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                <section class="box">
                    <div class="row gtr-50 gtr-uniform">

                        @foreach($updata as $t)
                            <div class="col-4">
                                <span class="image fit"><img src="{{ asset('images/logo.jfif') }}"></span>
                            </div>

                            <div class="col-8">
                                <h2>Canteen Food System</h2>
                            </div>

                            <div class="col-8">
                                <h3>This is your receipt.</h3>
                            </div>

                            <div class="col-4">
                                {{ date_format(date_create($t->created_at), 'h:i:s a d/m/Y') }}
                            </div>

                            <div class="col-12">
                                <b> Transaction ID : </b> {{ $t->txid }}
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Item</center></th>
                                                <th>Qty</center></th>
                                                <th>Assign</center></th>
                                                <th>Price(RM)</center></th>
                                            </tr>
                                        </thead>
                                        @foreach($orders as $o)
                                            <tr>
                                                <td>{{ ucfirst($o['menuname']) }}@RM{{ number_format($o['menuprice'], 2, '.', '') }}</center></td>
                                                <td>{{ $o['menuqty'] }}</center></td>
                                                <td>{{ ucfirst($o['studentname']) }}({{ strtoupper($o['studentid']) }}) @ {{ date_format(date_create($o->menudate), 'd/m/Y') }}</center></td>
                                                <td>{{ number_format($o['menuprice']*$o['menuqty'], 2, '.', '') }}</center></td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <h4><b>Grand Total:</b></h4>
                                            </td>
                                            <td>
                                                <h4><b>RM {{ number_format($t->txamount, 2, '.', '') }}</b></h4>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12">
                                <p>
                                    <b> Transaction Status : </b> {{ strtoupper($t->txstatus) }}  <br>
                                    <b> Transaction Reference : </b> {{ $t->txreference }} <br> 
                                    <b> Transaction Amount : </b> RM {{ number_format($t->txamount, 2, '.', '') }} <br>
                                </p>
                            </div>

                            <div class="col-12">
                                <p>
                                    <b>Payment Information.</b><br>
                                    <b> Issued To : </b> {{ ucfirst($t->fullname) }} <br>
                                    <b> Card Number: </b> ************{{substr($t->cardnum,-4)}} <br>
                                    <b> Card Merchant : </b> {{ strtoupper($t->cardtype) }}  <br>
                        @endforeach
                                </p>
                            </div>

                    </div>
                </section>
</div>
@endsection
