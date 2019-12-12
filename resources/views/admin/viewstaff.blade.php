@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Staff List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="box">
                        <a href="{{url('/staff/register')}}" class="button special fit small">Add New</a>
                        <p></p>

                        @if(!$staff->isEmpty())
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><center>Full Name</center></th>
                                            <th><center>Username</center></th>
                                            <th><center>Email</center></th>
                                            <th><center>Mobile Number</center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    @foreach($staff as $s)
                                        <tr>
                                            <td><center>{{ucfirst($s->fullname)}}</center></td>
                                            <td><center>{{$s->username}}</center></td>
                                            <td><center>{{$s->email}}</center></td>
                                            <td><center>{{$s->phonenum}}</center></td>
                                            <td><center>
                                                <form action="{{ route('admin.editstaff') }}" method="POST" enctype="multipart/form-data">
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
                            <p>No Staff data found.</p>
                        @endif
                    </section>
</div>
@endsection
