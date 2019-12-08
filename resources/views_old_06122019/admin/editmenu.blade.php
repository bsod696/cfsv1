@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Menu') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach( $updata as $u)
                    <form method="POST" action="{{ route('admin.submit.editmenu') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $u->id }}" required autocomplete="id" readonly>

                        <div class="form-group row">
                            <label for="foodname" class="col-md-4 col-form-label text-md-right">{{ __('Menu Name') }}</label>

                            <div class="col-md-6">
                                <input id="foodname" type="text" class="form-control @error('foodname') is-invalid @enderror" name="foodname" value="{{ $u->menuname }}" required autocomplete="foodname" autofocus>

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
                                <input id="fooddesc" type="textarea" class="form-control @error('fooddesc') is-invalid @enderror" name="fooddesc" value="{{ $u->menudesc }}" required autocomplete="fooddesc" autofocus>

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
                        </div>

                        <div class="form-group row">
                            <label for="foodprice" class="col-md-4 col-form-label text-md-right">{{ __('Menu Price (RM)') }}</label>

                            <div class="col-md-6">
                                <input id="foodprice" type="text" class="form-control @error('foodprice') is-invalid @enderror" name="foodprice" value="{{ $u->menuprice }}" required autocomplete="foodprice" autofocus>

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
                                <input id="foodcal" type="text" class="form-control @error('foodcal') is-invalid @enderror" name="foodcal" value="{{ $u->menucalories }}" required autocomplete="foodcal" autofocus>

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
                                <img id="foodp" src="{{ asset($u->menupic) }}" alt="your image" width="240" height="160" border="1"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="target_calories" class="col-md-4 col-form-label text-md-right">{{ __('Allergies') }}</label>

                            <div class="col-md-6 offset-md-0">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['shellfish'] == true ? 'checked' : '' }} value="shellfish">

                                    <label class="form-check-label" for="shellfish">
                                        {{ __('Shellfish') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['dairy'] == true ? 'checked' : '' }} value="dairy">

                                    <label class="form-check-label" for="dairy">
                                        {{ __('Dairy') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['peanuts'] == true ? 'checked' : '' }} value="peanuts">

                                    <label class="form-check-label" for="peanuts">
                                        {{ __('Peanuts') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['treenuts'] == true ? 'checked' : '' }} value="treenuts">

                                    <label class="form-check-label" for="treenuts">
                                        {{ __('Tree Nuts') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['eggs'] == true ? 'checked' : '' }} value="eggs">

                                    <label class="form-check-label" for="eggs">
                                        {{ __('Eggs') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['wheat'] == true ? 'checked' : '' }} value="wheat">

                                    <label class="form-check-label" for="wheat">
                                        {{ __('Wheat') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['soy'] == true ? 'checked' : '' }} value="soy">

                                    <label class="form-check-label" for="soy">
                                        {{ __('Soy') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['fish'] == true ? 'checked' : '' }} value="fish">

                                    <label class="form-check-label" for="fish">
                                        {{ __('Fish') }}
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ unserialize($u->allergyid)['noallergy'] == true ? 'checked' : '' }} value="noallergy">

                                    <label class="form-check-label" for="noallergy">
                                        {{ __('No Allergies') }}
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    @endforeach
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
