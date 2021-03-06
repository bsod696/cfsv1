@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Account Details List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>Click 'View' button to see further details of Account Details.</b></p>
                        <a href="{{url('/admin/storeaccount')}}">Add</a>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table class="table">
                                <col width="250">
                                <col width="80">
                                <col width="50">
                                <thead class="thead-dark">
                                @if(!empty($acc))
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
                                <td><center>
                                    <form action="{{ route('admin.editaccount') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $s->id }}" hidden />
                                        <button type="submit" name="submit" class="btn btn-primary">{{ __('View') }}</button>
                                    </form>
                                </center></td>
                                </tr>
                        @endforeach
                                @else
                                <p>No Account data found.</p>
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
