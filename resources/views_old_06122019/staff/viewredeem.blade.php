@extends('layouts.staff-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Redeem Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <h5><b>Redeem Item</b></h5>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                @foreach($redorder as $t)
                                    <p> <b> Student ID: </b> {{ strtoupper($t->studentid) }} </p>
                                    <p> <b> Student Name : </b> {{ ucfirst($t->studentname) }}  </p>
                                    <p> <b> Menu Name : </b> {{ ucfirst($t->menuname) }} </p> 
                                    <p> <b> Menu Quantity : </b> {{ $t->menuqty }} </p>
                                    <br>
                                    <br>
                                @endforeach
                                <center>
                                    <form action="{{ route('staff.redeem') }}" method="GET">
                                        <button type="submit" class="btn btn-primary">{{ __('Next Student') }}</button>
                                    </form>
                                </center>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
