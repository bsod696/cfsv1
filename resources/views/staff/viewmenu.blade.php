@extends('layouts.staff-app')

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
                                            <img align="top" src="{{ asset($m->menupic) }}" width="240" height="160" border="1">
                                        </td>
                                        <td>
                                            <h5>{{ucfirst($m->menuname)}}</h5>
                                            <p>
                                                <b>Description :</b> {{$m->menudesc}}<br>
                                                <b>Food Type :</b>
                                                 @if ($m->menutype == "food")
                                                    <img src="https://library.kissclipart.com/20180829/pfe/kissclipart-hot-meal-icon-clipart-dish-meal-restaurant-e2a7ae54daef81da.png" width="30" height="30"><br>
                                                @else
                                                    <img src="https://marketing.dcassetcdn.com/blog/2016/May/beverage-day-2016/21_300x300.png" width="30" height="30"><br>
                                                @endif
                                                <b>Allergens :</b>
                                                <br>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            @if (unserialize($m->allergyid)['shellfish'] == true)
                                                                <img src="https://png2.cleanpng.com/sh/b8097e645639cdfa6cd972b40492adee/L0KzQYm3UsE0N6d4j5H0aYP2gLBuTfZqe5kyiORqd36webT2jr1td5N4jNd7LUXkSIPtVcczQWhqSqkALkG5Q4G4U8UyOWY2UKc8MUm4RIe5UsEveJ9s/kisspng-fish-prawn-icon-lobster-5a82f57297e275.1630135115185319546221.png" width="30" height="30">
                                                                <label class="form-check-label" for="shellfish">
                                                                    {{ __('Shellfish') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['dairy'] == true)
                                                                <img src="https://webstockreview.net/images/clipart-milk-fresh-milk-11.png" width="30" height="30">
                                                                <label class="form-check-label" for="dairy">
                                                                    {{ __('Dairy') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['peanuts'] == true)
                                                                <img src="https://img.freepik.com/free-vector/peanut-icon-set_98396-180.jpg?size=626&ext=jpg" width="30" height="30">
                                                                <label class="form-check-label" for="peanuts">
                                                                    {{ __('Peanuts') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['treenuts'] == true)
                                                                <img src="https://www.netclipart.com/pp/m/96-964447_almond-png-transparent-image-you-meaning-in-urdu.png" width="30" height="30">
                                                                <label class="form-check-label" for="treenuts">
                                                                    {{ __('Tree Nuts') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['eggs'] == true)
                                                                <img src="https://icon-library.net/images/135629.svg.svg" width="30" height="30">
                                                                <label class="form-check-label" for="eggs">
                                                                    {{ __('Eggs') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['wheat'] == true)
                                                                <img src="https://www.creativefabrica.com/wp-content/uploads/2018/11/Agriculture-wheat-Logo-by-DEEMKA-STUDIO-580x406.jpg" width="30" height="30">
                                                                <label class="form-check-label" for="wheat">
                                                                    {{ __('Wheat') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['soy'] == true)
                                                                <img src="https://www.clipartwiki.com/clipimg/detail/222-2224585_seeds-clipart-soy-bean-soybean-seed-clipart.png" width="30" height="30">
                                                                <label class="form-check-label" for="soy">
                                                                    {{ __('Soy') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['fish'] == true)
                                                                <img src="https://library.kissclipart.com/20190925/wvq/kissclipart-green-logo-fish-font-bass-ac58e223ca4d21b5.png" width="30" height="30">
                                                                <label class="form-check-label" for="fish">
                                                                    {{ __('Fish') }}
                                                                </label>
                                                            @endif
                                                            @if (unserialize($m->allergyid)['noallergy'] == true)
                                                                <label class="form-check-label" for="noallergy">
                                                                    {{ __('No Allergens') }}
                                                                </label>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <br>

                                                <b>Price : RM</b> {{$m->menuprice}}<br>
                                                <b>Calories :</b> {{$m->menucalories}} Kcal<br>
                                            </p>
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
