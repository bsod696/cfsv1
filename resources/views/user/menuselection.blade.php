@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Student Menus') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <section class="box">

                        @foreach($menu as $m)
                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6">
                                <span class="image fit"><img src="{{ asset($m->menupic) }}"></span>
                            </div>

                            <div class="col-6">
                                <h3>{{ucfirst($m->menuname)}}</h3>
                                <p>
                                    <b>Description :</b> {{$m->menudesc}}<br>
                                    <b>Food Type :</b><br>
                                    @if ($m->menutype == "food")
                                        <img src="https://image.flaticon.com/icons/svg/203/203760.svg" width="30" height="30"><br>
                                    @else
                                        <img src="https://marketing.dcassetcdn.com/blog/2016/May/beverage-day-2016/21_300x300.png" width="30" height="30">
                                    @endif
                                </p>
                                <p>
                                    <b>Price : RM</b> {{$m->menuprice}}<br>
                                    <b>Calories :</b> {{$m->menucalories}} Kcal<br>
                                    <b>Allergens :</b>

                                                        @if (unserialize($m->allergyid)['shellfish'] == true)
                                                            <img src="https://png2.cleanpng.com/sh/b8097e645639cdfa6cd972b40492adee/L0KzQYm3UsE0N6d4j5H0aYP2gLBuTfZqe5kyiORqd36webT2jr1td5N4jNd7LUXkSIPtVcczQWhqSqkALkG5Q4G4U8UyOWY2UKc8MUm4RIe5UsEveJ9s/kisspng-fish-prawn-icon-lobster-5a82f57297e275.1630135115185319546221.png" width="30" height="30">
                                                            {{ __('Shellfish') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['dairy'] == true)
                                                            <img src="https://webstockreview.net/images/clipart-milk-fresh-milk-11.png" width="30" height="30">
                                                            {{ __('Dairy') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['peanuts'] == true)
                                                            <img src="https://img.freepik.com/free-vector/peanut-icon-set_98396-180.jpg?size=626&ext=jpg" width="30" height="30">
                                                            {{ __('Peanuts') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['treenuts'] == true)
                                                            <img src="https://www.netclipart.com/pp/m/96-964447_almond-png-transparent-image-you-meaning-in-urdu.png" width="30" height="30">
                                                            {{ __('Tree Nuts') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['eggs'] == true)
                                                            <img src="https://icon-library.net/images/135629.svg.svg" width="30" height="30">
                                                            {{ __('Eggs') }}
                                                            @endif
                                                        @if (unserialize($m->allergyid)['wheat'] == true)
                                                            <img src="https://www.creativefabrica.com/wp-content/uploads/2018/11/Agriculture-wheat-Logo-by-DEEMKA-STUDIO-580x406.jpg" width="30" height="30">
                                                            {{ __('Wheat') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['soy'] == true)
                                                            <img src="https://www.clipartwiki.com/clipimg/detail/222-2224585_seeds-clipart-soy-bean-soybean-seed-clipart.png" width="30" height="30">
                                                            {{ __('Soy') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['fish'] == true)
                                                            <img src="https://library.kissclipart.com/20190925/wvq/kissclipart-green-logo-fish-font-bass-ac58e223ca4d21b5.png" width="30" height="30">
                                                            {{ __('Fish') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['noallergy'] == true)
                                                            {{ __('No Allergens') }}
                                                        @endif
                                </p>
                            </div>

                        </div>

                        <form action="{{ route('user.submit.menuselect') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row gtr-50 gtr-uniform">

                                <div class="col-3">
                                    <b>Quantity :</b>

                                    <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />
                                    <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ Auth::user()->id }}" readonly hidden>

                                    <input id="foodqty" type="number" min="1" max="999" size="2" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="foodqty" value="{{ old('foodqty') }}" required autocomplete="foodqty" autofocus>

                                    @error('foodqty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-5">   
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
                                </div>

                                <div class="col-4">
                                    <b>Date to Serve :</b>
                                    
                                    <input type="date" id="dateserve" class="form-control{{ $errors->has('dateserve') ? ' is-invalid' : '' }}" name="dateserve" min="1900-01-01" required autofocus value="{{ old('dateserve') }}">
                                    
                                    @if ($errors->has('dateserve'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('dateserve') }}</strong>
                                        </span>
                                    @endif

                                    <input type="submit" value="{{ __('Add to Cart') }}" class="button special fit"></input>
                                </div>
                            </div>
                        </form>
                        @endforeach
                </section>
</div>
@endsection
