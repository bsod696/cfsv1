@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Order Summary') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        <!-- <a href="{{url('/staff/takeorder')}}" class="button special fit small">Add New</a>
                        <p></p> -->

                        <p>
                            <form method="POST" action="{{ route('admin.submit.ordersummary') }}">
                                @csrf

                                <div class="row gtr-50 gtr-uniform">

                                    <div class="col-4">
                                        Search based on Serve Date
                                    </div>

                                    <div class="col-6">
                                        <input id="servedate" type="date" class="unstyled" name="servedate" value="{{ old('servedate') }}" required autocomplete="servedate" autofocus>

                                        @error('servedate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-2">
                                        <input type="submit" value="{{ __('Search') }}" class="button special fit small"></input>
                                    </div>

                                </div>
                            </form>
                        </p>
                    </section>
                    
                    <section class="box">
                        <h3><b>Order Summary on: {{ $dateselected }}</b></h3>
                        @if(!empty($ordersorg))
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><center>Serve Date</center></th>
                                            <th><center>Menu</center></th>
                                            <th><center>Price</center></th>
                                            <th><center>Quantity</center></th>
                                            <th><center>Total</center></th>
                                        </tr>
                                    </thead>
                                    @foreach($ordersorg as $o)
                                        <tr>
                                            <td><center>{{$o['menudate']}}</center></td>
                                            <td><center>{{$o['menuname']}}</center></td>
                                            <td><center>RM {{$o['menuprice']}}</center></td>
                                            <td><center>{{$o['menuqty']}} units</center></td>
                                            <td><center>RM {{$o['totalpermenu']}}</center></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h4><b>Total Sales:</b></h4>
                                        </td>
                                        <td>
                                            <h4><b>RM {{ $totalsales }}</b></h4>
                                        </td>
                                        </tr>
                                </table>
                            </div>
                        @else
                            <p>No Orders data found.</p>
                        @endif
                    </section>
</div>
@endsection
