@extends('layouts.staff-app')
@section('content')
<header>
        <h2>{{ __('Orders List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                       <!--  <a href="{{url('/staff/takeorder')}}" class="button special fit small">Add New</a>
                        <p></p> -->

                        @if(!$orders->isEmpty())  
                            @foreach(array_combine($weeknum, $orders->toArray()) as $w => $op)
                                <div class="table-wrapper">
                                    <table>
                                        <thead>
                                            <th><center>Child</center></th>
                                            <th><center>Menu</center></th>
                                            <th><center>Price</center></th>
                                            <th><center>Quantity</center></th>
                                            <th><center>Total</center></th>
                                            <th><center>Serve Date</center></th>
                                            <th><center>Redeem Status</center></th>
                                            <th></th>
                                        </thead>
                                        <h3>
                                            <b>
                                            WEEK: {{ $w }} (
                                            {{ date_format(date_create(date('Y/m/d',strtotime(Carbon\Carbon::now()->format('Y').'W'.$w))), 'd/m/Y') }}
                                             - 
                                            {{ date_format(date_add(date_create(date('Y/m/d',strtotime(Carbon\Carbon::now()->format('Y').'W'.$w))),date_interval_create_from_date_string("4 days")), 'd/m/Y') }}
                                             )
                                            </b>
                                        </h3>
                                        @foreach($op as $o)
                                            <tr>
                                                <td><center>{{$o['studentname']}}</center></td>
                                                <td><center>{{$o['menuname']}}</center></td>
                                                <td><center>RM {{$o['menuprice']}}</center></td>
                                                <td><center>{{$o['menuqty']}} units</center></td>
                                                <td><center>RM {{number_format($o['menuprice']*$o['menuqty'], 2, '.', '')}}</center></td>
                                                <td><center>{{date_format(date_create($o['menudate']), 'd/m/Y')}}</center></td>
                                                @if($o['redeemstatus'] == 'REDEEMED')
                                                    <td>
                                                        <center>
                                                            REDEEMED <br>
                                                            ({{date_format(date_create($o['redeemdate']), 'h:i:s a d/m/Y')}})
                                                        </center>
                                                    </td>
                                                @else
                                                    <td><center>NOT REDEEM</center></td>
                                                @endif       
                                                <td><center>
                                                    <form action="{{ route('staff.vieworder') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row gtr-50 gtr-uniform">
                                                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o['id'] }}" hidden />

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
                            @endforeach    
                        @else
                            <p>No Orders data found.</p>
                        @endif
                    </section>
</div>
@endsection
