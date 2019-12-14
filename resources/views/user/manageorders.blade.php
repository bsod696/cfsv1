@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Manage Orders') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        <a href="{{url('/user/menuselect')}}" class="button special fit small">Add New</a>
                        <p></p>
                        @if(!$orders->isEmpty())
                            <h3><b>Unpaid Orders</b></h3>
                
                            <div class="table-wrapper">
                               
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><center>Child</center></th>
                                                <th><center>Menu</center></th>
                                                <th><center>Menu Date</center></th>
                                                <th><center>Price</center></th>
                                                <th><center>Quantity</center></th>
                                                <th><center>Total</center></th>
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
                                            <td><center>
                                                <form action="{{ route('user.submit.deleteorder') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input id="deleteid" type="hidden" class="form-control{{ $errors->has('deleteid') ? ' is-invalid' : '' }}" name="deleteid"  value="{{ $o->id }}" hidden/>
                                                    <input type="submit" value="{{ __('Remove') }}" class="button special fit small" onclick="return confirm('Are you sure you want to Remove this Order?');"></input>
                                                </form>
                                            </center></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <p>No Unpaid Orders found.</p>
                        @endif
                        
                    </section>
</div>
@endsection
