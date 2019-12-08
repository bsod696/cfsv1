@extends('layouts.staff-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order List') }}</div>

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
                                @if(!empty($orders))
                                <th><center>Student</center></th>
                                <th><center>Menu</center></th>
                                <th><center>Price</center></th>
                                <th><center>Quantity</center></th>
                                <th><center>Total</center></th>
                                <th><center>Serve Date</center></th>
                                <th></th>
                                <th></th>
                                </tr>
                        @foreach($orders as $o)
                                <tr>
                                <td><center>{{$o->studentname}}</center></td>
                                <td><center>{{$o->menuname}}</center></td>
                                <td><center>RM {{$o->menuprice}}</center></td>
                                <td><center>{{$o->menuqty}} units</center></td>
                                <td><center>RM {{number_format($o->menuprice*$o->menuqty, 2, '.', '')}}</center></td>
                                <td><center>{{date_format(date_create($o->menudate), 'd/m/Y')}}</center></td>
                                <td><center>
                                        <form action="{{ route('staff.vieworder') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $o->id }}" hidden />
                                            <button type="submit" name="submit" class="btn btn-primary">{{ __('View') }}</button>
                                        </form>
                                </center></td>
                            </tr>
                        @endforeach
                                @else
                                <p>No Orders data found.</p>
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
