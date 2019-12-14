@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Redeem Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                <section class="box">
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <h5><b>Successfully Redeemed !</b></h5>
                            @foreach($redorder as $t)
                                <p> <b> Student ID: </b> {{ strtoupper($t->studentid) }} </p>
                                <p> <b> Student Name : </b> {{ ucfirst($t->studentname) }}  </p>
                                <p> <b> Menu Name : </b> {{ ucfirst($t->menuname) }} </p> 
                                <p> <b> Menu Quantity : </b> {{ $t->menuqty }} </p>
                                <p> <b> Redeem Timestamp : </b> {{ date_format(date_create($t->redeemdate), 'h:i:s a d/m/Y') }} </p>
                             @endforeach
                        </div>
                    </div>

                    <a href="{{url('/staff/redeem')}}" class="button special fit small">Next Student'</a>
                </div>
            </section>
</div>
@endsection
