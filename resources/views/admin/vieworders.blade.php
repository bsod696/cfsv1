@extends('layouts.admin-app')

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
                        @if(!$orders->isEmpty())
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
                                            <td>
                                                @if ($o->txid == '')
                                                    <form action="{{ route('admin.submit.deleteorder') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row gtr-50 gtr-uniform">
                                                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />

                                                            <div class="col-12">
                                                                <ul class="actions special">
                                                                    <li>
                                                                        <input type="submit" value="{{ __('Remove') }}" class="button special fit small" onclick="return confirm('Are you sure you want to Remove this Order?');"></input>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.submit.viewtrans') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row gtr-50 gtr-uniform">
                                                            <input id="txid" type="hidden" class="form-control{{ $errors->has('txid') ? ' is-invalid' : '' }}" name="txid"  value="{{ $o->txid }}" hidden />

                                                            <div class="col-12">
                                                                <ul class="actions special">
                                                                    <li>
                                                                        <input type="submit" value="{{ __('View') }}" class="button special fit small"></input>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </table>
                        </div>
                    @else
                        <p>No Order data found.</p>
                    @endif
                </section>
</div>
@endsection
