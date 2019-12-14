@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Order Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                <section class="box">
                    @if($updata['orders']->redeemstatus != 'REDEEMED')
                        <form action="{{ route('staff.submit.cancelorder') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row gtr-50 gtr-uniform">
                                <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $updata['orders']->id }}" hidden />

                                <div class="col-12">
                                    <input type="submit" value="{{ __('Cancel Order') }}" class="button special fit small" onclick="return confirm('Are you sure you want to Cancel this Order?');"></input>
                                </div>
                        </form>
                        <p></p>
                    @endif
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <p> 
                                <b> Order Reference : </b>{{ $updata['orders']->id }} <br>
                                <b> Parent Reference: </b>{{ $updata['orders']->parentid }} <br>
                                <b> Child Name: </b>{{ ucfirst($updata['orders']->studentname) }} <br>
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
                                    <img src="{{ asset('images/203760.svg') }}" width="30" height="30"><br>
                                @else
                                    <img src="{{ asset('images/21_300x300.png') }}" width="30" height="30">
                                 @endif
                                <br>
                                <b> Menu Allergens: </b> <br>
                                <div class="table-wrapper">
                                    <table>
                                        <tr>
                                            <td>
                                                @if (unserialize($updata['menus']->allergyid)['shellfish'] == true)
                                                    <img src="{{ asset('images/240_F_75838492_xOLh2Y9ItCTanZ7JxS5wZIMswNiSazNO.jpg') }}" width="30" height="30">
                                                    {{ __('Shellfish') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['dairy'] == true)
                                                    <img src="{{ asset('images/milk.jfif') }}" width="30" height="30">
                                                    {{ __('Dairy') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['peanuts'] == true)
                                                    <img src="{{ asset('images/peanut-icon-set_98396-180.jpg') }}" width="30" height="30">
                                                        {{ __('Peanuts') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['treenuts'] == true)
                                                    <img src="{{ asset('images/96-964447_almond-png-transparent-image-you-meaning-in-urdu.png') }}" width="30" height="30">
                                                        {{ __('Tree Nuts') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['eggs'] == true)
                                                    <img src="{{ asset('images/135629.svg.svg') }}" width="30" height="30">
                                                    {{ __('Eggs') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['wheat'] == true)
                                                    <img src="{{ asset('images/Agriculture-wheat-Logo-by-DEEMKA-STUDIO-580x406.jpg') }}" width="30" height="30">
                                                    {{ __('Wheat') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['soy'] == true)
                                                    <img src="{{ asset('images/222-2224585_seeds-clipart-soy-bean-soybean-seed-clipart.png') }}" width="30" height="30">
                                                    {{ __('Soy') }}
                                                @endif
                                                @if (unserialize($updata['menus']->allergyid)['fish'] == true)
                                                    <img src="{{ asset('images/kissclipart-green-logo-fish-font-bass-ac58e223ca4d21b5.png') }}" width="30" height="30">
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
                                <b> Total Calories: </b>{{ $updata['orders']->menuqty*$updata['menus']->menucalories }} KCal <br>
                                <b> Redeem Status: </b>{{ $updata['orders']->redeemstatus }} <br>
                                @if($updata['orders']->redeemstatus == 'REDEEMED')
                                    <b> Redeem Date: </b>{{ date_format(date_create($updata['orders']->redeemdate), 'h:i:s a d/m/Y') }} <br>
                                @endif
                            </p>

                        </div>
                    </section>
</div>
@endsection
