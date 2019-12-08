@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Edit Menu Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach( $updata as $u)
                    <form method="POST" action="{{ route('admin.submit.editmenu') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $u->id }}" required autocomplete="id" readonly>

                        <div class="row gtr-50 gtr-uniform">
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="foodname" class="col-md-4 col-form-label text-md-right">{{ __('Menu Name') }}</label>
                                <input id="foodname" type="text" class="form-control @error('foodname') is-invalid @enderror" name="foodname" value="{{ $u->menuname }}" required autocomplete="foodname" autofocus>

                                @error('foodname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="fooddesc" class="col-md-4 col-form-label text-md-right">{{ __('Menu Description') }}</label>
                                <input id="fooddesc" type="textarea" class="form-control @error('fooddesc') is-invalid @enderror" name="fooddesc" value="{{ $u->menudesc }}" required autocomplete="fooddesc" autofocus>

                                @error('fooddesc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="foodtype" class="col-md-4 col-form-label text-md-right">{{ __('Menu Type') }}</label>
                                <select id="foodtype" class="form-control{{ $errors->has('foodtype') ? ' is-invalid' : '' }}" name="foodtype" required autofocus>
                                    <option value="{{ $u->menutype }}">{{ ucfirst($u->menutype) }}</option>
                                    <option value="food">Food</option>
                                    <option value="beverage">Beverage</option>
                                </select>
                                    
                                @if ($errors->has('foodtype'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foodtype') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="foodprice" class="col-md-4 col-form-label text-md-right">{{ __('Menu Price (RM)') }}</label>
                                <input id="foodprice" type="text" class="form-control @error('foodprice') is-invalid @enderror" name="foodprice" value="{{ $u->menuprice }}" required autocomplete="foodprice" autofocus>

                                @error('foodprice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="foodcal" class="col-md-4 col-form-label text-md-right">{{ __('Menu Calories (KCal)') }}</label>
                                <input id="foodcal" type="number" class="form-control @error('foodcal') is-invalid @enderror" name="foodcal" value="{{ $u->menucalories }}" required autocomplete="foodcal" autofocus>

                                @error('foodcal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="foodpic" class="col-md-4 col-form-label text-md-right">{{ __('Menu Picture') }}</label>
                                <img id="foodp" src="{{ asset($u->menupic) }}" alt="your image" width="240" height="160" border="1"/>
                            </div>

                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Allergens</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['shellfish'] == true ? 'checked' : '' }} value="shellfish">

                                    <label class="form-check-label" for="shellfish">
                                        {{ __('Shellfish') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['dairy'] == true ? 'checked' : '' }} value="dairy">

                                    <label class="form-check-label" for="dairy">
                                        {{ __('Dairy') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['peanuts'] == true ? 'checked' : '' }} value="peanuts">

                                    <label class="form-check-label" for="peanuts">
                                        {{ __('Peanuts') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['treenuts'] == true ? 'checked' : '' }} value="treenuts">

                                    <label class="form-check-label" for="treenuts">
                                        {{ __('Tree Nuts') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['eggs'] == true ? 'checked' : '' }} value="eggs">

                                    <label class="form-check-label" for="eggs">
                                        {{ __('Eggs') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['wheat'] == true ? 'checked' : '' }} value="wheat">

                                    <label class="form-check-label" for="wheat">
                                        {{ __('Wheat') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['soy'] == true ? 'checked' : '' }} value="soy">

                                    <label class="form-check-label" for="soy">
                                        {{ __('Soy') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['fish'] == true ? 'checked' : '' }} value="fish">

                                    <label class="form-check-label" for="fish">
                                        {{ __('Fish') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['noallergy'] == true ? 'checked' : '' }} value="noallergy">

                                    <label class="form-check-label" for="noallergy">
                                        {{ __('No Allergens') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Update') }}"></input>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </form>
</div>
<script>
    function showBMI() {
        var height = document.getElementById('height').value;
        var weight = document.getElementById('weight').value;
        var bmicalc = 0.0;
        bmicalc = parseFloat((weight/Math.pow(height, 2))*10000).toFixed(1);
        document.getElementById('bmi').value=bmicalc; 
    }

    function readURLfoodpic(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {$('#foodp').attr('src', e.target.result).width(250).height(150);};
        reader.readAsDataURL(input.files[0]);
    }
}

    // function getClass(){
    //     var today = new Date();
    //     var birthDate = new Date(document.getElementById('dob').value);
    //     var age = today.getFullYear() - birthDate.getFullYear();
    //     var m = today.getMonth() - birthDate.getMonth();
    //     if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())){age--;}
    //     document.getElementById('age').value=age;
    // }
</script>
@endsection
