@extends('layouts.staff-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Orders Summary') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p><b>Click 'Add' button to add your Orders.</b></p>
                        <a href="{{url('/staff/takeorder')}}">Add</a>
                        <br>
                        <table class="table">
                            <tr>
                                <td>
                                    <form method="POST" action="{{ route('staff.submit.ordersummary') }}">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="servedate" class="col-md-4 col-form-label text-md-left">{{ __('Search based on Serve Date') }}</label>

                                            <div class="col-md-4">
                                                <input id="servedate" type="date" class="form-control @error('servedate') is-invalid @enderror" name="servedate" value="{{ old('servedate') }}" required autocomplete="servedate" autofocus>

                                                @error('servedate')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- <div class="col-md-2 offset-md-4"> -->
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Search') }}
                                            </button>
                                            <!-- </div> -->
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </table>

                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                                
                            <table class="table">
                                <thead class="thead-dark">

                                <tr>
                                @if(!empty($ordersorg))
                                <th><center>Serve Date</center></th>
                                <th><center>Menu</center></th>
                                <th><center>Price</center></th>
                                <th><center>Quantity</center></th>
                                <th><center>Total</center></th>
                                <th></th>
                                <th></th>
                                </tr>
                        @foreach($ordersorg as $o)
                                <tr>
                                <td><center>{{$o['menudate']}}</center></td>
                                <td><center>{{$o['menuname']}}</center></td>
                                <td><center>RM {{$o['menuprice']}}</center></td>
                                <td><center>{{$o['menuqty']}} units</center></td>
                                <td><center>RM {{$o['totalpermenu']}}</center></td>
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
