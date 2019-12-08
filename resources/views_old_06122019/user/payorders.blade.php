@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Pay Orders') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <h5><b>Checkout Item</b></h5>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                @foreach($orders as $o)
                                    <p> <b> Student ID: </b> {{ strtoupper($o->studentid) }} </p>
                                    <p> <b> Student Name : </b> {{ ucfirst($o->studentname) }}  </p>
                                    <p> <b> Menu Name : </b> {{ ucfirst($o->menuname) }} </p>
                                    <p> <b> Menu Price : </b> RM {{ $o->menuprice }} </p> 
                                    <p> <b> Menu Quantity : </b> {{ $o->menuqty }} </p>
                                    <p> <b> Menu Serving Date : </b>{{date_format(date_create($o->menudate), 'd/m/Y')}}
                                    <p> <b> Total Amount : </b> RM {{ number_format($o->menuprice*$o->menuqty, 2, '.', '') }} </p> 
                                    <br>
                                    <br>
                               
                                    <center>
                                        <form action="{{ route('user.submit.payorder') }}" method="POST">
                                            @csrf

                                            <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $o->id }}" readonly hidden>

                                            <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>

                                            <button type="submit" class="btn btn-primary">{{ __('Pay Now') }}</button>
                                        </form>
                                    </center>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
