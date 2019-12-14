@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Payment List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        <a href="{{url('/admin/storepayment')}}" class="button special fit small">Add New</a>
                        <p></p>

                        @if(!$pay->isEmpty())
                            <div class="table-wrapper">
                                <table>
                                    @foreach($pay as $s)
                                        <tr>
                                            <td>
                                                <b>Full Name : </b>{{$s->fullname}}
                                                <br>
                                                <b>Card Number : </b>**** **** **** {{substr($s->cardnum,-4)}}
                                                <br>
                                                <b>Card Type : </b>{{strtoupper($s->cardtype)}}
                                                <br>
                                                <b>Expiry Date : </b>{{$s->expdate}}
                                                <br>
                                                <b>Billing Address : </b>
                                                <br>
                                                {{$s->billaddr1}},
                                                {{$s->billaddr2}},
                                                {{$s->zipcode}},
                                                {{$s->city}},   
                                                {{$s->state}},
                                                {{$s->country}}
                                                <br>
                                                <b>Default : </b>
                                                    @if($s->defaultpay == 'Y')
                                                        <b>YES</b>
                                                    @else
                                                        <b>NO</b>
                                                    @endif
                                            </td>
                                            <td><center>
                                                <form action="{{ route('admin.editpayment') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gtr-50 gtr-uniform">
                                                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $s->id }}" hidden />

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
                            <p>No Payment data found.</p>
                        @endif
                    </section>
</div>
@endsection
