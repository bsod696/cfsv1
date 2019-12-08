@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Order Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <section class="box">

                    <form action="{{ route('staff.submit.cancelorder') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gtr-50 gtr-uniform">
                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $updata['orders']->id }}" hidden />

                            <div class="col-12">
                                <input type="submit" value="{{ __('Cancel Order') }}" class="button special fit small"></input>
                            </div>
                    </form>

                    <p></p>
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <p> 
                                <b> Order Reference : </b>{{ $updata['orders']->id }} <br>
                                <b> Parent Reference: </b>{{ $updata['orders']->parentid }} <br>
                                <b> Student Name: </b>{{ ucfirst($updata['orders']->studentname) }} <br>
                                <b> Transaction ID : </b>{{ $updata['orders']->txid }} <br>
                                <b> Transaction Amount : </b>RM {{ number_format($updata['orders']->menuprice*$updata['orders']->menuqty, 2, '.', '') }} <br>
                                <b> Serving Date : </b>{{ date_format(date_create($updata['orders']->menudate), 'd/m/Y') }} <br>
                            </p>
                                   
                            <p> 
                                <b> Menu Name: </b>{{ ucfirst($updata['menus']->menuname) }} <br>
                                <img align="top" src="{{ asset($updata['menus']->menupic) }}" width="240" height="160" border="1"> <br>
                                <b> Menu Description: </b>{{ $updata['menus']->menudesc }} </p>
                                <b> Menu Type: </b>
                                @if ($updata['menus']->menutype == "food")
                                    <img src="https://library.kissclipart.com/20180829/pfe/kissclipart-hot-meal-icon-clipart-dish-meal-restaurant-e2a7ae54daef81da.png" width="30" height="30">
                                @else
                                    <img src="https://marketing.dcassetcdn.com/blog/2016/May/beverage-day-2016/21_300x300.png" width="30" height="30">
                                @endif 
                                <br>
                                <b> Menu Allergens: </b> <br>
                                <div class="table-wrapper">
                                    <table>
                                        <tr>
                                            <td>
                                                @if (unserialize($updata['menus']->allergyid)['shellfish'] == true)
                                                    <img src="https://png2.cleanpng.com/sh/b8097e645639cdfa6cd972b40492adee/L0KzQYm3UsE0N6d4j5H0aYP2gLBuTfZqe5kyiORqd36webT2jr1td5N4jNd7LUXkSIPtVcczQWhqSqkALkG5Q4G4U8UyOWY2UKc8MUm4RIe5UsEveJ9s/kisspng-fish-prawn-icon-lobster-5a82f57297e275.1630135115185319546221.png" width="30" height="30">
                                                    {{ __('Shellfish') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['dairy'] == true)
                                                    <img src="https://webstockreview.net/images/clipart-milk-fresh-milk-11.png" width="30" height="30">
                                                    {{ __('Dairy') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['peanuts'] == true)
                                                    <img src="https://img.freepik.com/free-vector/peanut-icon-set_98396-180.jpg?size=626&ext=jpg" width="30" height="30">
                                                        {{ __('Peanuts') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['treenuts'] == true)
                                                    <img src="https://www.netclipart.com/pp/m/96-964447_almond-png-transparent-image-you-meaning-in-urdu.png" width="30" height="30">
                                                        {{ __('Tree Nuts') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['eggs'] == true)
                                                    <img src="https://icon-library.net/images/135629.svg.svg" width="30" height="30">
                                                    {{ __('Eggs') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['wheat'] == true)
                                                    <img src="https://www.creativefabrica.com/wp-content/uploads/2018/11/Agriculture-wheat-Logo-by-DEEMKA-STUDIO-580x406.jpg" width="30" height="30">
                                                    {{ __('Wheat') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['soy'] == true)
                                                    <img src="https://www.clipartwiki.com/clipimg/detail/222-2224585_seeds-clipart-soy-bean-soybean-seed-clipart.png" width="30" height="30">
                                                    {{ __('Soy') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['fish'] == true)
                                                    <img src="https://library.kissclipart.com/20190925/wvq/kissclipart-green-logo-fish-font-bass-ac58e223ca4d21b5.png" width="30" height="30">
                                                    {{ __('Fish') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['noallergy'] == true)
                                                        {{ __('No Allergens') }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <b> Menu Price: </b>RM {{ $updata['menus']->menuprice }} <br>
                                <b> Menu Quantity: </b>{{ $updata['orders']->menuqty }} Units <br>
                                <b> Menu Calories: </b>{{ $updata['menus']->menucalories }} KCal <br>
                            </p>

                        </div>
                    </section>
</div>
@endsection
