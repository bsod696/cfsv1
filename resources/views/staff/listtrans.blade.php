@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Transactions List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{url('/staff/takeorder')}}" class="button special fit small">Add New</a>

                    <section class="box">
                        <div class="table-wrapper">

                            <table>
                                <thead>
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
                                </thead>
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
                                <p>No Transaction data found.</p>
                            @endif
                            </table>
                        </div>
                    </section>
</div>
@endsection
