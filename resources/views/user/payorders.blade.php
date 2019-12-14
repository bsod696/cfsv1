@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Pay Orders') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        <div class="row gtr-50 gtr-uniform">
                            <h4><b>{{ __('Checkout Item') }}</b></h4>
                        </div>

                        <div class="row gtr-50 gtr-uniform">
                            @foreach($orders as $op)
                                @foreach($op as $o)
                                    <div class="col-6 col-12-mobilep">
                                        <p> 
                                            <h4><b><u>#order{{ $o->id }}</u></b></h4>
                                            <b> Student ID: </b> {{ strtoupper($o->studentid) }} <br>
                                            <b> Child Name : </b> {{ ucfirst($o->studentname) }}  <br>
                                            <b> Menu Name : </b> {{ ucfirst($o->menuname) }} <br>
                                            <b> Menu Price : </b> RM {{ $o->menuprice }}  <br>
                                            <b> Menu Quantity : </b> {{ $o->menuqty }} <br>
                                            <b> Menu Serving Date : </b>{{date_format(date_create($o->menudate), 'd/m/Y')}} <br>
                                        </p> 
                                    </div>
                                @endforeach
                            @endforeach
                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <div class="col-12">
                                <h4><b> Grand Total : RM {{ number_format($grandtotal, 2, '.', '') }} </b></h4>
                            </div>

                            <div class="col-12">
                                <form action="{{ route('user.submit.payorder') }}" method="POST">
                                    @csrf

                                    @foreach($orders as $op)
                                        @foreach($op as $o)
                                            <input id="{{ $o->id }}" type="hidden" class="form-control @error('selectorder') is-invalid @enderror" name="selectorder[]" value="{{ $o->id }}" readonly hidden>
                                        @endforeach
                                    @endforeach
                                
                                    <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>
                                    <input id="gtotal" type="hidden" class="form-control @error('gtotal') is-invalid @enderror" name="gtotal" value="{{ $grandtotal }}" readonly hidden>
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
                                    <input type="submit" value="{{ __('Pay Now') }}" class="button special fit small" onclick="return confirm('Confirm Payment?');"></input>
                            </div>
                                </form>
                            </div>

                        </div>
                    </section>
</div>
@endsection
