@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>Click 'Pay' button to pay for your Orders.</b></p>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table class="table">
                                <col width="100">
                                <thead class="thead-dark">

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
                        @foreach($orders as $o)
                                <tr>
                                <td><center>{{$o->studentname}}</center></td>
                                <td><center>{{$o->menu_name}}</center></td>
                                <td><center>{{date_format(date_create($o->menu_date), 'd/m/Y')}}</center></td>
                                <td><center>RM {{$o->menu_price}}</center></td>
                                <td><center>{{$o->menu_qty}} units</center></td>
                                <td><center>RM {{number_format($o->menu_price*$o->menu_qty, 2, '.', '')}}</center></td>
                                @if ($o->txid == '')
                                    <td><center>UNPAID</center></td>
                                @else
                                    <td><center>PAID</center></td>
                                @endif
                                <td><center>
                                    @if ($o->txid == '')
                                        <form action="{{ route('user.submit.payorder') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input id="parentid" type="text" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>
                                            <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />
                                            <button type="submit" name="submit" class="btn btn-primary">{{ __('Pay') }}</button>
                                        </form>
                                    @else
                                        <form action="{{ route('user.submit.viewtrans') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input id="parentid" type="text" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>
                                            <input id="txid" type="text" class="form-control{{ $errors->has('txid') ? ' is-invalid' : '' }}" name="txid"  value="{{ $o->txid }}" hidden />
                                            <button type="submit" name="submit" class="btn btn-primary">{{ __('View') }}</button>
                                        </form>
                                    @endif
                                </center></td>
                                @if ($o->txid == '')
                                    <td><center>
                                        <form action="{{ route('user.submit.deleteorder') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />
                                            <button type="submit" name="submit" class="btn btn-primary">{{ __('x') }}</button>
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
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
