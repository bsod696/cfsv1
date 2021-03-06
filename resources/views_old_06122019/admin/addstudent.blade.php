@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Student') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.submit.storestudent') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="studentid" class="col-md-4 col-form-label text-md-right">{{ __('Student ID') }}</label>

                            <div class="col-md-6">
                                <input id="studentid" type="text" class="form-control @error('studentid') is-invalid @enderror" name="studentid" value="{{ old('studentid') }}" required autocomplete="studentid" autofocus>

                                @error('studentid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" required autofocus>
                                    <option value="">--Select One--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                    
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">  
                                <input type="date" id="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" min="1900-01-01" required autofocus>
                                    
                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Current Classroom') }}</label>

                            <div class="col-md-6">
                                <select id="class" class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" required autofocus>
                                    <option value="">--Select One--</option>
                                    <option value="1A">1A</option>
                                    <option value="2A">2A</option>
                                    <option value="3A">3A</option>
                                    <option value="4A">4A</option>
                                    <option value="5A">5A</option>
                                    <option value="6A">6A</option>
                                </select>
                                    
                                @if ($errors->has('class'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="school_session" class="col-md-4 col-form-label text-md-right">{{ __('School Session') }}</label>

                            <div class="col-md-6">
                                <select id="school_session" class="form-control{{ $errors->has('school_session') ? ' is-invalid' : '' }}" name="school_session" required autofocus>
                                    <option value="">--Select One--</option>
                                    <option value="morning">Morning</option>
                                    <option value="afternoon">Afternoon</option>
                                </select>
                                    
                                @if ($errors->has('school_session'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school_session') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height (CM)') }}</label>

                            <div class="col-md-6">
                                <input id="height" type="number" min="1" max="500" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" required autocomplete="height" autofocus>

                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (KG)') }}</label>

                            <div class="col-md-6">
                                <input id="weight" type="number" min="1" max="500" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" required autocomplete="weight" autofocus onchange="showBMI()">

                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bmi" class="col-md-4 col-form-label text-md-right">{{ __('Body Mass Index (BMI)') }}</label>

                            <div class="col-md-6">
                                <input id="bmi" type="text" class="form-control @error('bmi') is-invalid @enderror" name="bmi" readonly required autocomplete="bmi" autofocus>

                                @error('bmi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="target_calories" class="col-md-4 col-form-label text-md-right">{{ __('Target Calories (Kcal)') }}</label>

                            <div class="col-md-6">
                                <input id="target_calories" type="number" min="1" max="10000" class="form-control @error('target_calories') is-invalid @enderror" name="target_calories" value="{{ old('target_calories') }}" required autocomplete="target_calories" autofocus>

                                @error('target_calories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="allergy" {{ old('allergy') ? 'checked' : '' }} value="noallergy">

                                    <label class="form-check-label" for="noallergy">
                                        {{ __('No Allergies') }}
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="primary" class="col-md-4 col-form-label text-md-right">{{ __('Primary/Secondary guardian') }}</label>
                       
                            <div class="col-md-6">
                                <select id="primary" class="form-control{{ $errors->has('primary') ? ' is-invalid' : '' }}" name="primary" required autofocus>
                                    <option value="">--Select One--</option>
                                    <option value="true">Primary</option>
                                    <option value="false">Secondary</option>
                                </select>
                                    
                                @if ($errors->has('primary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('primary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> -->

                        <div class="form-group row">
                            <label for="parentid" class="col-md-4 col-form-label text-md-right">{{ __('Parent ID') }}</label>
                       
                            <div class="col-md-6">
                                <select id="parentid" class="form-control{{ $errors->has('parentid') ? ' is-invalid' : '' }}" name="parentid" required autofocus>
                                    <option value="">--Select One--</option>
                                    @foreach($parent as $p)
                                    <option value="parentid">{{ ucfirst($p->fullname) }} ({{ $p->id }})</option>
                                    @endforeach
                                </select>
                                    
                                @if ($errors->has('parentid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('parentid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <!--  <input id="parentid" type="text" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="ADMIN_{{ Auth::guard('admin')->user()->id }}" readonly hidden> -->

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
