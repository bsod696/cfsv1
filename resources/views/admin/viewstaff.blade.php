@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Staff List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>Click 'View' button to see further details of Staff.</b></p>
                        <a href="{{url('/staff/register')}}">Add</a>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table class="table">
                                <col width="250">
                                <col width="80">
                                <col width="50">
                                <thead class="thead-dark">

                                <tr>
                                @if(!empty($staff))
                                <th><center>Full Name</center></th>
                                <th><center>Username</center></th>
                                <th><center>Email</center></th>
                                <th><center>Mobile Number</center></th>
                                <th></th>
                                </tr>
                        @foreach($staff as $s)
                                <tr>
                                <td><center>{{ucfirst($s->fullname)}}</center></td>
                                <td><center>{{$s->username}}</center></td>
                                <td><center>{{$s->email}}</center></td>
                                <td><center>{{$s->phonenum}}</center></td>
                                <td><center>
                                    <form action="{{ route('admin.editstaff') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $s->id }}" hidden />
                                        <button type="submit" name="submit" class="btn btn-primary">{{ __('View') }}</button>
                                    </form>
                                </center></td>
                                </tr>
                        @endforeach
                                @else
                                <p>No Staff data found.</p>
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
