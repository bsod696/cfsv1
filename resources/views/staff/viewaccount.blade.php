@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Account Details List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="box">
                        <a href="{{url('/staff/storeaccount')}}" class="button special fit small">Add New</a>
                        <p></p>
                        
                        @if(!$acc->isEmpty())
                            <div class="table-wrapper">
                                <table>
                                    @foreach($acc as $s)
                                        <tr>
                                            <td>
                                                <b>Full Name : </b>{{$s->fullname}}
                                                <br>
                                                <b>Bank Name : </b>{{strtoupper($s->bankname)}}
                                                <br>
                                                <b>Account Number : </b>{{strtoupper($s->banknum)}}
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
                                            <td>
                                                <form action="{{ route('staff.editaccount') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row gtr-50 gtr-uniform">
                                                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $s->id }}" hidden />

                                                        <div class="col-12">
                                                            <ul class="actions special">
                                                                <li>
                                                                    <input type="submit" value="{{ __('View') }}"></input>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        @else
                            <p>No Account data found.</p>
                        @endif
                    </section>
</div>
@endsection