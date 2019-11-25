@extends('layouts.admin-app')

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
                            <table class="table">
                                <col width="250">
                                <col width="80">
                                <col width="50">
                                <thead class="thead-dark">

                                <tr>
                                @if(!empty($stud))
                                <th><center>Full Name</center></th>
                                <th><center>StudentID</center></th>
                                <th><center>Class</center></th>
                                <th><center>Session</center></th>
                                <th><center>Gender</center></th>
                                <th><center>BMI</center></th>
                                <th><center>Calories(Kcal)</center></th>
                                <th></th>
                                </tr>
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
                                    <form action="{{ route('admin.editstudent') }}" method="POST" enctype="multipart/form-data">
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
