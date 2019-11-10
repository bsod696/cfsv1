@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>Click 'View' button to see further details of Student.</b></p>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table>
                                <tr>
                                @if(!empty($stud))
                                <th>Full Name</th>
                                <th>Student ID</th>
                                <th>Class</th>
                                <th>School Session</th>
                                <th>Gender</th>
                                <th>BMI</th>
                                <th>Target Calories(Kcal)</th>
                                </tr>
                        @foreach($stud as $s)
                                <tr>
                                <td><center>{{$s->fullname}}</center></td>
                                <td><center>{{$s->studentid}}</center></td>
                                <td><center>{{$s->class}}</center></td>
                                <td><center>{{$s->school_session}}</center></td>
                                <td><center>{{$s->gender}}</center></td>
                                <td><center>{{$s->bmi}}</center></td>
                                <td><center>{{$s->target_calories}}</center></td>
                                <td><center>
                                    <form action="{{ route('user.editstudent') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $s->id }}" hidden />
                                        <button type="submit" name="submit" class="btn btn-primary">{{ __('View') }}</button>
                                    </form>
                                </center></td>
                                </tr>
                        @endforeach
                                @else
                                <p>No Student data found.</p>
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
