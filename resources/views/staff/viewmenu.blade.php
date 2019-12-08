@extends('layouts.staff-app')

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
                        <!-- <div class="table-wrapper"> -->
                        <!-- <a href="{{url('/admin/storemenu')}}" class="button special fit small">Add New</a>
                        <p></p> -->

                        <div class="row gtr-50 gtr-uniform">

                        <!-- <table> -->
                        @foreach($menu as $m)
                                    <!-- <tr> -->
                                        <!-- <td> -->
                                            <!-- <div class="box alt"> -->
                                            <!-- <div class="row gtr-50 gtr-uniform"> -->
                            <div class="col-6">
                                <span class="image fit"><img src="{{ asset($m->menupic) }}"></span>
                            </div>
                                            <!-- </div> -->
                                            <!-- </div>  -->
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
                                                            <!-- <label class="form-check-label" for="shellfish">
                                                                {{ __('Shellfish') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['dairy'] == true)
                                                            <img src="https://webstockreview.net/images/clipart-milk-fresh-milk-11.png" width="30" height="30">
                                                            {{ __('Dairy') }}
                                                            <!-- <label class="form-check-label" for="dairy">
                                                                {{ __('Dairy') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['peanuts'] == true)
                                                            <img src="https://img.freepik.com/free-vector/peanut-icon-set_98396-180.jpg?size=626&ext=jpg" width="30" height="30">
                                                            {{ __('Peanuts') }}
                                                            <!-- <label class="form-check-label" for="peanuts">
                                                                {{ __('Peanuts') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['treenuts'] == true)
                                                            <img src="https://www.netclipart.com/pp/m/96-964447_almond-png-transparent-image-you-meaning-in-urdu.png" width="30" height="30">
                                                            {{ __('Tree Nuts') }}
                                                            <!-- <label class="form-check-label" for="treenuts">
                                                                {{ __('Tree Nuts') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['eggs'] == true)
                                                            <img src="https://icon-library.net/images/135629.svg.svg" width="30" height="30">
                                                            {{ __('Eggs') }}
                                                            <!-- <label class="form-check-label" for="eggs">
                                                                {{ __('Eggs') }}
                                                            </label> -->
                                                            @endif
                                                        @if (unserialize($m->allergyid)['wheat'] == true)
                                                            <img src="https://www.creativefabrica.com/wp-content/uploads/2018/11/Agriculture-wheat-Logo-by-DEEMKA-STUDIO-580x406.jpg" width="30" height="30">
                                                            {{ __('Wheat') }}
                                                            <!-- <label class="form-check-label" for="wheat">
                                                                {{ __('Wheat') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['soy'] == true)
                                                            <img src="https://www.clipartwiki.com/clipimg/detail/222-2224585_seeds-clipart-soy-bean-soybean-seed-clipart.png" width="30" height="30">
                                                            {{ __('Soy') }}
                                                            <!-- <label class="form-check-label" for="soy">
                                                                {{ __('Soy') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['fish'] == true)
                                                            <img src="https://library.kissclipart.com/20190925/wvq/kissclipart-green-logo-fish-font-bass-ac58e223ca4d21b5.png" width="30" height="30">
                                                            {{ __('Fish') }}
                                                            <!-- <label class="form-check-label" for="fish">
                                                                {{ __('Fish') }}
                                                            </label> -->
                                                        @endif
                                                        @if (unserialize($m->allergyid)['noallergy'] == true)
                                                            {{ __('No Allergens') }}
                                                            <!-- <label class="form-check-label" for="noallergy">
                                                                {{ __('No Allergens') }}
                                                            </label> -->
                                                        @endif
                                    
                                <!-- </p> -->

                                <!-- <p> -->
                                    <!-- <ul class="actions fit">
                                        <li><form action="{{ route('admin.editmenuimage') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row gtr-50 gtr-uniform">
                                                <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />

                                                <div class="col-12">
                                                    <ul class="actions special">
                                                        <li>
                                                            <input type="submit" value="{{ __('Edit Image') }}"></input>
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
                                                            <input type="submit" value="{{ __('Edit Menu') }}"></input>
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
                                                            <input type="submit" value="{{ __('Delete Menu') }}"></input>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form></li>
                                    </ul> -->
                                </p>
                                            <!-- <p>
                                                <form action="{{ route('admin.editmenu') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />
                                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('Edit Menu') }}</button>
                                                </form>
                                            </p>
                                            <p>
                                                <form action="{{ route('admin.submit.deletemenu') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $m->id }}" hidden />
                                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('Delete Menu') }}</button>
                                                </form>
                                            </p> -->
                            </div>
                        @endforeach
                    </div>
                </section>
</div>
@endsection
