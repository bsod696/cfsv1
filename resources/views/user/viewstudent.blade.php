@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Child List') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        <a href="{{url('/user/storestudent')}}" class="button special fit small">Add New</a>
                        <p></p>

                        @if(!$stud->isEmpty())
                            <div class="table-wrapper">
                                <table>
                                    <thead>
                                        <tr>
                                            <th><center>Full Name</center></th>
                                            <th><center>StudentID</center></th>
                                            <th><center>Class</center></th>
                                            <th><center>Session</center></th>
                                            <th><center>Gender</center></th>
                                            <th><center>BMI</center></th>
                                            <th><center>Calories(Kcal)</center></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                     @foreach($stud as $s)
                                        <tr>
                                            <td><center>{{ucfirst($s->fullname)}}</center></td>
                                            <td><center>{{strtoupper($s->studentid)}}</center></td>
                                            <td><center>{{strtoupper($s->class)}}</center></td>
                                            <td><center>{{ucfirst($s->school_session)}}</center></td>
                                            <td><center>{{ucfirst($s->gender)}}</center></td>
                                            <td><center>{{$s->bmi}}</center></td>
                                            <td><center>{{$s->target_calories}}</center></td>
                                            <td><center>
                                                <form action="{{ route('user.editstudent') }}" method="POST" enctype="multipart/form-data">
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
                            <p>No Student data found.</p>
                        @endif
                    </section>
</div>
@endsection