@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Transaction List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>Click 'View' button to view your Transaction.</b></p>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table class="table">
                                <col width="100">
                                <thead class="thead-dark">

                                <tr>
                                @if(!empty($trans))
                                <th><center>Transaction ID</center></th>
                                <th><center>Amount</center></th>
                                <th><center>Reference</center></th>
                                <th><center>Status</center></th>
                                <th></th>
                                </tr>
                        @foreach($trans as $t)
                                <tr>
                                <td><center>{{$t->txid}}</center></td>
                                <td><center>RM {{$t->tx_amount}}</center></td>
                                <td><center>{{$t->tx_reference}}</center></td>
                                <td><center>{{ strtoupper($t->tx_status) }}</center></td>
                                <td><center>
                                    <form action="{{ route('user.submit.viewtrans') }}" method="POST" enctype="multipart/form-data">
                                         @csrf
                                        <input id="parentid" type="text" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>
                                        <input id="txid" type="text" class="form-control{{ $errors->has('txid') ? ' is-invalid' : '' }}" name="txid"  value="{{ $t->txid }}" hidden />
                                        <button type="submit" name="submit" class="btn btn-primary">{{ __('View') }}</button>
                                    </form>
                                </center></td>
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
