@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Student Menus') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-0">
                            <table class="table">
                        @foreach($menu as $m)
                                <tr>
                                        <td>
                                            <img align="top" src="{{$m->menupic}}" width="240" height="160" border="1">
                                        </td>
                                        <td>
                                            <h5>{{ucfirst($m->menuname)}}</h5>
                                            <p>
                                                <b>Description :</b> {{$m->menudesc}}<br>
                                                <b>Food Type :</b>
                                                @if ($m->menutype == "food")
                                                    <img src="https://image.flaticon.com/icons/png/128/857/857681.png" width="20" height="20"><br>
                                                @else
                                                    <img src="https://cdn3.iconfinder.com/data/icons/drinks-beverages/91/Drinks__Beverages_27-512.png" width="30" height="30"><br>
                                                @endif
                                                <b>Allergens :</b> {{substr($m->allergyid, 1, -1)}}<br>
                                                <b>Price : RM</b> {{$m->menuprice}}<br>
                                                <b>Calories :</b> {{$m->menucalories}} Kcal<br>
                                            </p>
                                            <p>
                                                <b>Quantity :</b>

                                                <form action="{{ route('admin.submit.menuselect') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />
                                                    <input id="foodqty" type="number" min="1" max="999" size="2" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="foodqty" value="{{ old('foodqty') }}" required autocomplete="foodqty" autofocus>

                                                    @error('foodqty')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </p>
                                            <p>
                                                <b>Assign To :</b>
                                                    <select id="studentid" class="form-control{{ $errors->has('studentid') ? ' is-invalid' : '' }}" name="studentid" required autofocus>
                                                        <option value="">--Select One--</option>
                                                        @foreach($stud as $s)
                                                            <option value="{{ $s->studentid }}">{{ $s->fullname }}</option>
                                                        @endforeach
                                                    </select>
                                    
                                                    @if ($errors->has('studentid'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('studentid') }}</strong>
                                                        </span>
                                                    @endif
                                            </p>
                                                    <input id="parentid" type="text" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="ADMIN_{{ Auth::guard('admin')->user()->id }}" readonly hidden>
                                            <p align="right"><button type="submit" name="submit" class="btn btn-primary">{{ __('Add to Cart') }}</button></p>
                                        </td>
                                    </form>
                                </tr>
                        @endforeach
                            </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
