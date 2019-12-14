@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Child Menus') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <section class="box">
                        <a href="{{url('/admin/storemenu')}}" class="button special fit small">Add New</a>
                    </section>

                        @if(!$menu->isEmpty())
                                @foreach($menu as $m)
                                <section class="box">
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
                                                <img src="{{ asset('images/203760.svg') }}" width="30" height="30"><br>
                                            @else
                                                <img src="{{ asset('images/21_300x300.png') }}" width="30" height="30">
                                            @endif
                                        </p>
                                        <p>
                                            <b>Price : RM</b> {{$m->menuprice}}<br>
                                            <b>Calories :</b> {{$m->menucalories}} Kcal<br>
                                            <b>Allergens :</b>

                                                        @if (unserialize($m->allergyid)['shellfish'] == true)
                                                            <img src="{{ asset('images/240_F_75838492_xOLh2Y9ItCTanZ7JxS5wZIMswNiSazNO.jpg') }}" width="30" height="30">
                                                            {{ __('Shellfish') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['dairy'] == true)
                                                            <img src="{{ asset('images/milk.jfif') }}" width="30" height="30">
                                                            {{ __('Dairy') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['peanuts'] == true)
                                                            <img src="{{ asset('images/peanut-icon-set_98396-180.jpg') }}" width="30" height="30">
                                                            {{ __('Peanuts') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['treenuts'] == true)
                                                            <img src="{{ asset('images/96-964447_almond-png-transparent-image-you-meaning-in-urdu.png') }}" width="30" height="30">
                                                            {{ __('Tree Nuts') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['eggs'] == true)
                                                            <img src="{{ asset('images/135629.svg.svg') }}" width="30" height="30">
                                                            {{ __('Eggs') }}
                                                            @endif
                                                        @if (unserialize($m->allergyid)['wheat'] == true)
                                                            <img src="{{ asset('images/Agriculture-wheat-Logo-by-DEEMKA-STUDIO-580x406.jpg') }}" width="30" height="30">
                                                            {{ __('Wheat') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['soy'] == true)
                                                            <img src="{{ asset('images/222-2224585_seeds-clipart-soy-bean-soybean-seed-clipart.png') }}" width="30" height="30">
                                                            {{ __('Soy') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['fish'] == true)
                                                            <img src="{{ asset('images/kissclipart-green-logo-fish-font-bass-ac58e223ca4d21b5.png') }}" width="30" height="30">
                                                            {{ __('Fish') }}
                                                        @endif
                                                        @if (unserialize($m->allergyid)['noallergy'] == true)
                                                            {{ __('No Allergens') }}
                                                        @endif
                                            <ul class="actions fit">
                                                <li><form action="{{ route('admin.editmenuimage') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gtr-50 gtr-uniform">
                                                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />

                                                        <div class="col-12">
                                                            <ul class="actions special">
                                                                <li>
                                                                    <input type="submit" value="{{ __('Edit Image') }}" class="button special small"></input>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form></li>

                                                <li><form action="{{ route('admin.editmenu') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gtr-50 gtr-uniform">
                                                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />

                                                        <div class="col-12">
                                                            <ul class="actions special">
                                                                <li>
                                                                    <input type="submit" value="{{ __('Edit Menu') }}" class="button special small"></input>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form></li>
                
                                                <li><form action="{{ route('admin.submit.deletemenu') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row gtr-50 gtr-uniform">
                                                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />

                                                        <div class="col-12">
                                                            <ul class="actions special">
                                                                <li>
                                                                    <input type="submit" value="{{ __('Remove Menu') }}" class="button special small" onclick="return confirm('Are you sure you want to Remove this Menu?');"></input>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </form></li>
                                            </ul>
                                        </p>
                                    </div>
                                </div>
                                </section>
                                @endforeach
                        @else
                            <section class="box">
                                    <p>No Menu data found.</p>
                            </section>
                        @endif
</div>
@endsection
