@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Cart') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="box">
                        <a href="{{url('/user/menuselect')}}" class="button special fit small">Add New</a>
                        <p></p>
                        
                        @if(!$orders->isEmpty())
                            <h3><b>Unpaid Orders</b></h3>
                            <a href="{{url('/user/deleteorder')}}" class="button special small">Manage Orders</a>
                            
                            <form action="{{ route('user.payorder') }}" method="POST" id="checkout" enctype="multipart/form-data">
                                @csrf
                            </form>
                
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><center>Student</center></th>
                                            <th><center>Menu</center></th>
                                            <th><center>Menu Date</center></th>
                                            <th><center>Price</center></th>
                                            <th><center>Quantity</center></th>
                                            <th><center>Total</center></th>
                                        </tr>
                                    </thead>
                                    @foreach($orders as $o)
                                        <tr>
                                            <td>
                                                <div class="col-6 col-12-mobilep">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="selectorder[]" id="{{ $o->id }}" {{ old('selectorder') ? 'checked' : '' }} value="{{ $o->id }}" form="checkout">

                                                        <label class="form-check-label" for="{{ $o->id }}">
                                                            {{ __('') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><center>{{$o->studentname}}</center></td>
                                            <td><center>{{$o->menuname}}</center></td>
                                            <td><center>{{date_format(date_create($o->menudate), 'd/m/Y')}}</center></td>
                                            <td><center>RM {{$o->menuprice}}</center></td>
                                            <td><center>{{$o->menuqty}} units</center></td>
                                            <td><center>RM {{number_format($o->menuprice*$o->menuqty, 2, '.', '')}}</center></td>
                                        </tr>
                                    @endforeach
                                </table>
                        </div>
                        <input type="submit" value="{{ __('Proceed to Checkout') }}" form="checkout" class="button special fit small"></input>
                    @else
                        <p>No Unpaid Orders found.</p>
                    @endif
                        
                    <p></p>
                    </section>

                    <section class="box">
                        @if(!$ordersp->isEmpty())
                            <h3><b>Paid Orders</b></h3>
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><center>Student</center></th>
                                            <th><center>Menu</center></th>
                                            <th><center>Menu Date</center></th>
                                            <th><center>Price</center></th>
                                            <th><center>Quantity</center></th>
                                            <th><center>Total</center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach($ordersp as $o)
                                    <tr>
                                        <td><center>{{$o->studentname}}</center></td>
                                        <td><center>{{$o->menuname}}</center></td>
                                        <td><center>{{date_format(date_create($o->menudate), 'd/m/Y')}}</center></td>
                                        <td><center>RM {{$o->menuprice}}</center></td>
                                        <td><center>{{$o->menuqty}} units</center></td>
                                        <td><center>RM {{number_format($o->menuprice*$o->menuqty, 2, '.', '')}}</center></td>
                                        <td><center>
                                            <form action="{{ route('user.submit.viewtrans') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>
                                                <input id="txid" type="hidden" class="form-control{{ $errors->has('txid') ? ' is-invalid' : '' }}" name="txid"  value="{{ $o->txid }}" hidden />
                                                <input type="submit" value="{{ __('View') }}" class="button special fit small"></input>
                                            </form>
                                            <h5>Paid On: {{ date_format(date_create($o->updated_at), 'h:i:s a d/m/Y') }}</h5>
                                        </center></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                         @else
                            <p>No Paid Orders found.</p>
                        @endif
                    </section>
</div>
@endsection
