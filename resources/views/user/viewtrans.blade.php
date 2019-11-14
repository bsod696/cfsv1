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
                                    <p> Menu Reference: {{ $t->menu_id }} </p>
                                    <p> Order Reference : {{ $t->order_id }}  </p>
                                    <p> Transaction Status : {{ strtoupper($t->tx_status) }}  </p>
                                    <p> Transaction Reference : {{ $t->tx_reference }} </p> 
                                    <p> Transaction Amount : RM {{ $t->tx_amount }} </p>
                                    <p> Transaction ID : {{ $t->txid }} </p>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
