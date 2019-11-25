@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Menu') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.submit.storemenu') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="foodname" class="col-md-4 col-form-label text-md-right">{{ __('Menu Name') }}</label>

                            <div class="col-md-6">
                                <input id="foodname" type="text" class="form-control @error('foodname') is-invalid @enderror" name="foodname" value="{{ old('foodname') }}" required autocomplete="foodname" autofocus>

                                @error('foodname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fooddesc" class="col-md-4 col-form-label text-md-right">{{ __('Menu Description') }}</label>

                            <div class="col-md-6">
                                <input id="fooddesc" type="textarea" class="form-control @error('fooddesc') is-invalid @enderror" name="fooddesc" value="{{ old('fooddesc') }}" required autocomplete="fooddesc" autofocus>

                                @error('fooddesc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foodtype" class="col-md-4 col-form-label text-md-right">{{ __('Menu Type') }}</label>

                            <div class="col-md-6">
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
                        </div>

                        <div class="form-group row">
                            <label for="foodprice" class="col-md-4 col-form-label text-md-right">{{ __('Menu Price (RM)') }}</label>

                            <div class="col-md-6">
                                <input id="foodprice" type="text" class="form-control @error('foodprice') is-invalid @enderror" name="foodprice" value="{{ old('foodprice') }}" required autocomplete="foodprice" autofocus>

                                @error('foodprice')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foodcal" class="col-md-4 col-form-label text-md-right">{{ __('Menu Calories (KCal)') }}</label>

                            <div class="col-md-6">
                                <input id="foodcal" type="text" class="form-control @error('foodcal') is-invalid @enderror" name="foodcal" value="{{ old('foodcal') }}" required autocomplete="foodcal" autofocus>

                                @error('foodcal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foodpic" class="col-md-4 col-form-label text-md-right">{{ __('Menu Picture') }}</label>

                            <div class="col-md-6">
                                <input id="foodpic" type="file" class="form-control{{ $errors->has('foodpic') ? ' is-invalid' : '' }}" name="foodpic" value="{{ old('foodpic') }}" required autocomplete="foodpic" autofocus onchange="readURLfoodpic(this);">
                                <img id="foodp" src="#" alt="your image" />

                                @if ($errors->has('foodpic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foodpic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="target_calories" class="col-md-4 col-form-label text-md-right">{{ __('Allergies') }}</label>

                            <div class="col-md-6 offset-md-0">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="shellfish">

                                    <label class="form-check-label" for="shellfish">
                                        {{ __('Shellfish') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="dairy">

                                    <label class="form-check-label" for="dairy">
                                        {{ __('Dairy') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="peanuts">

                                    <label class="form-check-label" for="peanuts">
                                        {{ __('Peanuts') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="treenuts">

                                    <label class="form-check-label" for="treenuts">
                                        {{ __('Tree Nuts') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="eggs">

                                    <label class="form-check-label" for="eggs">
                                        {{ __('Eggs') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="wheat">

                                    <label class="form-check-label" for="wheat">
                                        {{ __('Wheat') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="soy">

                                    <label class="form-check-label" for="soy">
                                        {{ __('Soy') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="fish">

                                    <label class="form-check-label" for="fish">
                                        {{ __('Fish') }}
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
