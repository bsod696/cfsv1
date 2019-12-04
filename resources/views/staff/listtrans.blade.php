@extends('layouts.staff-app')

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
                        <p><b>Click 'Add' button to add your Orders.</b></p>
                        <a href="{{url('/staff/takeorder')}}">Add</a>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table class="table">
                                <col width="100">
                                <thead class="thead-dark">

                                <tr>
                                @if(!empty($trans))
                                <th><center>Serve Date</center></th>
                                <th><center>Menu</center></th>
                                <th><center>Price</center></th>
                                <th><center>Quantity</center></th>
                                <th><center>Total</center></th>
                                <th></th>
                                <th></th>
                                </tr>
                        @foreach($trans as $t)
                                <tr>
                                <td><center>{{$t->menudate}}</center></td>
                                <td><center>{{$t->menuname}}</center></td>
                                <td><center>RM {{$t->menuprice}}</center></td>
                                <td><center>{{$t->menuqty}} units</center></td>
                                <td><center>RM {{$t->totalpermenu}}</center></td>
                            </tr>
                        @endforeach
                                @else
                                <p>No Transactions data found.</p>
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
