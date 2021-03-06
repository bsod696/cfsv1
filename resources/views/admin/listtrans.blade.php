@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Transactions List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        @if(!$trans->isEmpty())
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><center>Transaction ID</center></th>
                                            <th><center>Parent ID</center></th>
                                            <th><center>Amount</center></th>
                                            <th><center>Reference</center></th>
                                            <th><center>Status</center></th>
                                            <th><center>Transaction Date</center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach($trans as $t)
                                        <tr>
                                            <td><center>{{$t->txid}}</center></td>
                                            <td><center>{{$t->parentid}}</center></td>
                                            <td><center>RM {{$t->txamount}}</center></td>
                                            <td><center>{{$t->txreference}}</center></td>
                                            <td><center>{{ strtoupper($t->txstatus) }}</center></td>
                                            <td><center>{{ date_format(date_create($t->created_at), 'h:i:s a d/m/Y') }}</center></td>
                                            <td><center>
                                                <form action="{{ route('admin.submit.viewtrans') }}" method="POST" enctype="multipart/form-data">
                                                     @csrf

                                                    <div class="row gtr-50 gtr-uniform">
                                                        <input id="txid" type="hidden" class="form-control{{ $errors->has('txid') ? ' is-invalid' : '' }}" name="txid"  value="{{ $t->txid }}" hidden />

                                                        <div class="col-12">
                                                            <ul class="actions special">
                                                                <li>
                                                                    <input type="submit" value="{{ __('View') }}" class="button special fit small"></input>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form>
                                            </center></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <p>No Transaction data found.</p>
                        @endif
                    </section>
</div>
@endsection
