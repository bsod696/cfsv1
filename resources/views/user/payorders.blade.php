@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Pay Orders') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="box">
                        <h4><b>{{ __('Checkout Item') }}</b></h4>
                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-12">
                                @foreach($orders as $o)
                                    <p> 
                                        <b> Student ID: </b> {{ strtoupper($o->studentid) }} <br>
                                        <b> Student Name : </b> {{ ucfirst($o->studentname) }}  <br>
                                        <b> Menu Name : </b> {{ ucfirst($o->menuname) }} <br>
                                        <b> Menu Price : </b> RM {{ $o->menuprice }}  <br>
                                        <b> Menu Quantity : </b> {{ $o->menuqty }} <br>
                                        <b> Menu Serving Date : </b>{{date_format(date_create($o->menudate), 'd/m/Y')}} <br>
                                        <b> Total Amount : </b> RM {{ number_format($o->menuprice*$o->menuqty, 2, '.', '') }} 
                                    </p> 
                            </div>

                            <div class="col-12">
                                <form action="{{ route('user.submit.payorder') }}" method="POST">
                                    @csrf

                                    <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $o->id }}" readonly hidden>
                                    <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>

                                    <label for="paymentid" class="col-md-4 col-form-label text-md-right">{{ __('Payment Card') }}</label>
                                    <select id="paymentid" class="form-control{{ $errors->has('paymentid') ? ' is-invalid' : '' }}" name="paymentid" required autofocus>
                                            <option value="">--Select One--</option>
                                                @foreach($payments as $p)
                                                    <option value="{{ $p->id }}">{{ ucfirst($p->fullname) }} {{ $p->cardnum  }} ({{ strtoupper($p->cardtype)  }})</option>
                                                @endforeach
                                    </select>
                                            
                                    @if ($errors->has('paymentid'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('paymentid') }}</strong>
                                        </span>
                                    @endif
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Pay Now') }}"></input>
                                    </li>
                                </ul>
                            </form>
                            </div>
                                @endforeach
                        </div>
                    </section>
</div>
@endsection
