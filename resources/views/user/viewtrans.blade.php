@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>This is your receipt.</b></p>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                @foreach($trans as $t)
                                    @foreach($orders as $o)
                                        <p> <b> Menu Name: </b> {{ ucfirst($o->menuname) }} </p>
                                        <p> <b> Menu Quantity: </b> {{ $o->menuqty }} Units</p>
                                        <p> <b> Student ID : </b> {{ strtoupper($o->studentid) }}  </p>
                                        <p> <b> Student Name : </b> {{ ucfirst($o->studentname) }}  </p>
                                    @endforeach
                                    <p> <b> Transaction Status : </b> {{ strtoupper($t->txstatus) }}  </p>
                                    <p> <b> Transaction Reference : </b> {{ $t->txreference }} </p> 
                                    <p> <b> Transaction Amount : </b> RM {{ $t->txamount }} </p>
                                    <p> <b> Transaction ID : </b> {{ $t->txid }} </p>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
