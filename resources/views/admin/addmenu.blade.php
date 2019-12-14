@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Add Menu') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <form method="POST" action="{{ route('admin.submit.storemenu') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row gtr-50 gtr-uniform">
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="foodname" class="col-md-4 col-form-label text-md-right">{{ __('Menu Name') }}</label>
                                <input id="foodname" type="text" class="form-control @error('foodname') is-invalid @enderror" name="foodname" value="{{ old('foodname') }}" required autocomplete="foodname" autofocus>

                                @error('foodname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="fooddesc" class="col-md-4 col-form-label text-md-right">{{ __('Menu Description') }}</label>
                                <input id="fooddesc" type="text" class="form-control @error('fooddesc') is-invalid @enderror" name="fooddesc" value="{{ old('fooddesc') }}" required autocomplete="fooddesc" autofocus>

                                @error('fooddesc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="foodtype" class="col-md-4 col-form-label text-md-right">{{ __('Menu Type') }}</label>
                                <select id="foodtype" class="form-control{{ $errors->has('foodtype') ? ' is-invalid' : '' }}" name="foodtype" required autofocus>
                                    <option value="">--Select One--</option>
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
                                <input id="foodprice" type="text" class="form-control @error('foodprice') is-invalid @enderror" name="foodprice" value="{{ old('foodprice') }}" required autocomplete="foodprice" autofocus>

                                @error('foodprice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="foodcal" class="col-md-4 col-form-label text-md-right">{{ __('Menu Calories (KCal)') }}</label>
                                <input id="foodcal" type="text" class="form-control @error('foodcal') is-invalid @enderror" name="foodcal" value="{{ old('foodcal') }}" required autocomplete="foodcal" autofocus>

                                @error('foodcal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="foodpic" class="col-md-4 col-form-label text-md-right">{{ __('Menu Picture') }}</label>
                                <input id="foodpic" type="file" class="form-control{{ $errors->has('foodpic') ? ' is-invalid' : '' }}" name="foodpic" value="{{ old('foodpic') }}" required autocomplete="foodpic" autofocus onchange="readURLfoodpic(this);">
                                <img id="foodp" src="#" alt="your image" width="240" height="160" border="1"/>

                                @if ($errors->has('foodpic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foodpic') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Allergens</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="shellfish" {{ old('allergy') ? 'checked' : '' }} value="shellfish">

                                    <label class="form-check-label" for="shellfish">
                                        {{ __('Shellfish') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="dairy" {{ old('allergy') ? 'checked' : '' }} value="dairy">

                                    <label class="form-check-label" for="dairy">
                                        {{ __('Dairy') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="peanuts" {{ old('allergy') ? 'checked' : '' }} value="peanuts">

                                    <label class="form-check-label" for="peanuts">
                                        {{ __('Peanuts') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="treenuts" {{ old('allergy') ? 'checked' : '' }} value="treenuts">

                                    <label class="form-check-label" for="treenuts">
                                        {{ __('Tree Nuts') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="eggs" {{ old('allergy') ? 'checked' : '' }} value="eggs">

                                    <label class="form-check-label" for="eggs">
                                        {{ __('Eggs') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="wheat" {{ old('allergy') ? 'checked' : '' }} value="wheat">

                                    <label class="form-check-label" for="wheat">
                                        {{ __('Wheat') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="soy" {{ old('allergy') ? 'checked' : '' }} value="soy">

                                    <label class="form-check-label" for="soy">
                                        {{ __('Soy') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="fish" {{ old('allergy') ? 'checked' : '' }} value="fish">

                                    <label class="form-check-label" for="fish">
                                        {{ __('Fish') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="noallergy" {{ old('allergy') ? 'checked' : '' }} value="noallergy">

                                    <label class="form-check-label" for="noallergy">
                                        {{ __('No Allergens') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Add') }}"></input>
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
