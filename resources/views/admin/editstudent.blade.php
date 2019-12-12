@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Edit Student Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    @foreach( $updata as $u)
                    <form action="{{ route('admin.submit.deletestudent') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gtr-50 gtr-uniform">
                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Remove Student Detail') }}" class="button special small" onclick="return confirm('Are you sure you want to Remove this Student?');"></input>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('admin.submit.editstudent') }}">
                        @csrf
                        <div class="row gtr-50 gtr-uniform">

                            <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />

                            <div class="col-6 col-12-mobilep">
                                <label for="studentid" class="col-md-4 col-form-label text-md-right">{{ __('Student ID') }}</label>
                                <input id="studentid" type="text" class="form-control @error('studentid') is-invalid @enderror" name="studentid" value="{{ $u->studentid }}" required autocomplete="studentid" autofocus>

                                @error('studentid')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $u->fullname }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                                <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ ucfirst($u->gender) }}" required autocomplete="gender" autofocus>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>
                                <input type="date" id="dob" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" min="1900-01-01" required autofocus value="{{ $u->dob }}">
                                    
                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="class" class="col-md-4 col-form-label text-md-right">{{ __('Current Classroom') }}</label>
                                <select id="class" class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}" name="class" required autofocus>
                                    <option value="{{ $u->class }}">{{ $u->class }}</option>
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
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="school_session" class="col-md-4 col-form-label text-md-right">{{ __('School Session') }}</label>
                                <select id="school_session" class="form-control{{ $errors->has('school_session') ? ' is-invalid' : '' }}" name="school_session" required autofocus>
                                    <option value="{{ $u->school_session }}">{{ ucfirst($u->school_session) }}</option>
                                    <option value="morning">Morning</option>
                                    <option value="afternoon">Afternoon</option>
                                </select>
                                    
                                @if ($errors->has('school_session'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('school_session') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="height" class="col-md-4 col-form-label text-md-right">{{ __('Height (CM)') }}</label>
                                <input id="height" type="number" min="1" max="500" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ $u->height }}" required autocomplete="height" autofocus>

                                @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $height }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight (KG)') }}</label>
                                <input id="weight" type="number" min="1" max="500" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $u->weight }}" required autocomplete="weight" autofocus onchange="showBMI()">

                                @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="bmi" class="col-md-4 col-form-label text-md-right">{{ __('Body Mass Index (BMI)') }}</label>
                                <input id="bmi" type="number" class="form-control @error('bmi') is-invalid @enderror" name="bmi" readonly required autocomplete="bmi" autofocus>

                                @error('bmi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                             </div>
                            
                            <div class="col-6 col-12-mobilep">
                                <label for="target_calories" class="col-md-4 col-form-label text-md-right">{{ __('Target Calories (Kcal)') }}</label>
                                <input id="target_calories" type="number" min="1" max="10000" class="form-control @error('target_calories') is-invalid @enderror" name="target_calories" value="{{ $u->target_calories }}" required autocomplete="target_calories" autofocus>

                                @error('target_calories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Allergies</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="shellfish" {{ unserialize($u->allergies)['shellfish'] == true ? 'checked' : '' }} value="shellfish">

                                    <label class="form-check-label" for="shellfish">
                                        {{ __('Shellfish') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="dairy" {{ unserialize($u->allergies)['dairy'] == true ? 'checked' : '' }} value="dairy">

                                    <label class="form-check-label" for="dairy">
                                        {{ __('Dairy') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="peanuts" {{ unserialize($u->allergies)['peanuts'] == true ? 'checked' : '' }} value="peanuts">

                                    <label class="form-check-label" for="peanuts">
                                        {{ __('Peanuts') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="treenuts" {{ unserialize($u->allergies)['treenuts'] == true ? 'checked' : '' }} value="treenuts">

                                    <label class="form-check-label" for="treenuts">
                                        {{ __('Tree Nuts') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="eggs" {{ unserialize($u->allergies)['eggs'] == true ? 'checked' : '' }} value="eggs">

                                    <label class="form-check-label" for="eggs">
                                        {{ __('Eggs') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="wheat" {{ unserialize($u->allergies)['wheat'] == true ? 'checked' : '' }} value="wheat">

                                    <label class="form-check-label" for="wheat">
                                        {{ __('Wheat') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="soy" {{ unserialize($u->allergies)['soy'] == true ? 'checked' : '' }} value="soy">

                                    <label class="form-check-label" for="soy">
                                        {{ __('Soy') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="fish" {{ unserialize($u->allergies)['fish'] == true ? 'checked' : '' }} value="fish">

                                    <label class="form-check-label" for="fish">
                                        {{ __('Fish') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="allergy[]" id="noallergy" {{ unserialize($u->allergies)['noallergy'] == true ? 'checked' : '' }} value="noallergy">

                                    <label class="form-check-label" for="noallergy">
                                        {{ __('No Allergies') }}
                                    </label>
                                </div>
                            </div>
                        
                            <div class="col-12">
                                <label for="parentid" class="col-md-4 col-form-label text-md-right">{{ __('Parent ID') }}</label>
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

                            <!-- <div class="col-6 col-12-mobilep">
                                <label for="primary" class="col-md-4 col-form-label text-md-right">{{ __('Primary/Secondary guardian') }}</label>
                                <select id="primary" class="form-control{{ $errors->has('primary') ? ' is-invalid' : '' }}" name="primary" required autofocus>
                                    @if ($u->primary_parentid != null)
                                    <option value="true">Primary</option>
                                    @else
                                    <option value="false">Secondary</option>
                                    @endif
                                    <option value="true">Primary</option>
                                    <option value="false">Secondary</option>
                                </select>
                                    
                                @if ($errors->has('primary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('primary') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <input id="primary_parentid" type="hidden" class="form-control @error('primary_parentid') is-invalid @enderror" name="primary_parentid" value="{{ $u->primary_parentid }}" readonly hidden>
                            <input id="secondary_parentid" type="hidden" class="form-control @error('secondary_parentid') is-invalid @enderror" name="secondary_parentid" value="{{ $u->secondary_parentid }}" readonly hidden> -->

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Update') }}"></input>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </form>
                    @endforeach
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
