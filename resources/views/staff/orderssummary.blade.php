@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Order Summary') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{url('/staff/takeorder')}}" class="button special fit small">Add New</a>

                    <p>
                        <form method="POST" action="{{ route('staff.submit.ordersummary') }}">
                            @csrf

                            <div class="row gtr-50 gtr-uniform">

                                <div class="col-4">
                                    Search based on Serve Date
                                </div>

                                <div class="col-6">
                                    <input id="servedate" type="date" class="form-control @error('servedate') is-invalid @enderror" name="servedate" value="{{ old('servedate') }}" required autocomplete="servedate" autofocus>

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
                    
                    <section class="box">
                        <div class="table-wrapper">
                                
                            <table>
                                <thead>
                                    <tr>
                                @if(!empty($ordersorg))
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
                                @else
                                <p>No Orders data found.</p>
                                @endif
                            </table>
                            </div>
                        </section>
</div>
@endsection
