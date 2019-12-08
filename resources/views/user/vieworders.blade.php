@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Order List') }}</h2>
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
                        
                        <div class="table-wrapper">

                            <table>
                                <thead>
                                    <tr>
                            @if(!empty($orders))
                                        <th><center>Student</center></th>
                                        <th><center>Menu</center></th>
                                        <th><center>Menu Date</center></th>
                                        <th><center>Price</center></th>
                                        <th><center>Quantity</center></th>
                                        <th><center>Total</center></th>
                                        <th><center>Status</center></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                        @foreach($orders as $o)
                                <tr>
                                    <td><center>{{$o->studentname}}</center></td>
                                    <td><center>{{$o->menuname}}</center></td>
                                    <td><center>{{date_format(date_create($o->menudate), 'd/m/Y')}}</center></td>
                                    <td><center>RM {{$o->menuprice}}</center></td>
                                    <td><center>{{$o->menuqty}} units</center></td>
                                    <td><center>RM {{number_format($o->menuprice*$o->menuqty, 2, '.', '')}}</center></td>
                                    @if ($o->txid == '')
                                        <td><center>UNPAID</center></td>
                                    @else
                                        <td><center>PAID</center></td>
                                    @endif
                                    <td><center>
                                        @if ($o->txid == '')
                                            <form action="{{ route('user.payorder') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />
                                                <input type="submit" value="{{ __('Pay') }}"></input>
                                            </form>
                                        @else
                                            <form action="{{ route('user.submit.viewtrans') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>
                                                <input id="txid" type="hidden" class="form-control{{ $errors->has('txid') ? ' is-invalid' : '' }}" name="txid"  value="{{ $o->txid }}" hidden />
                                                <input type="submit" value="{{ __('View') }}"></input>
                                            </form>
                                        @endif
                                    </center></td>
                                    @if ($o->txid == '')
                                        <td><center>
                                            <form action="{{ route('user.submit.deleteorder') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />
                                                <input type="submit" value="{{ __('X') }}"></input>
                                            </form>
                                        </center></td>
                                    @endif
                                </tr>
                        @endforeach
                            @else
                                <p>No Student data found.</p>
                            @endif
                            </table>
                        </div>
                    </section>
</div>
@endsection
