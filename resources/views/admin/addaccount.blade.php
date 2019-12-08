@extends('layouts.admin-app')

@section('content')
<header>
        <h2>{{ __('Add Account Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    <form method="POST" action="{{ route('admin.submit.storeaccount') }}">
                        @csrf

                        <div class="row gtr-50 gtr-uniform">
                           
                            <div class="col-6 col-12-mobilep">
                                <label for="staffid" class="col-md-4 col-form-label text-md-right">{{ __('Staff ID') }}</label>
                                <select id="staffid" class="form-control{{ $errors->has('staffid') ? ' is-invalid' : '' }}" name="staffid" required autofocus>
                                    <option value="">--Select One--</option>
                                        @foreach($staff as $s)
                                            <option value="{{ $s->id }}">{{ ucfirst($s->fullname)  }} ({{ $s->id  }})</option>
                                        @endforeach
                                </select>
                                    
                                @if ($errors->has('staffid'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('staffid') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Account Info</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ old('fullname') }}" required autocomplete="fullname" autofocus>

                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="bankname" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>
                                <input id="bankname" type="text" class="form-control @error('bankname') is-invalid @enderror" name="bankname" value="{{ old('bankname') }}" required autocomplete="bankname" autofocus>

                                @error('bankname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="banknum" class="col-md-4 col-form-label text-md-right">{{ __('Account Number') }}</label>
                                <input id="banknum" type="text" class="form-control @error('banknum') is-invalid @enderror" name="banknum" value="{{ old('banknum') }}" required autocomplete="banknum" autofocus>

                                @error('banknum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Billing Address</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <label for="billaddr1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>
                                <input id="billaddr1" type="text" class="form-control @error('billaddr1') is-invalid @enderror" name="billaddr1" value="{{ old('billaddr1') }}" required autocomplete="billaddr1" autofocus>

                                @error('billaddr1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="billaddr2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>
                                <input id="billaddr2" type="text" class="form-control @error('billaddr2') is-invalid @enderror" name="billaddr2" value="{{ old('billaddr2') }}" required autocomplete="billaddr2" autofocus>

                                @error('billaddr2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('Zipcode') }}</label>
                                <input id="zipcode" type="number" maxlength="5" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>

                                @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
                                <select id="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" required autofocus>
                                    <option value="">--Select One--</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                    <option value="Labuan">Labuan</option>
                                    <option value="Putrajaya">Putrajaya</option>
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Malacca">Malacca</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Penang">Penang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                </select>
                                    
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="Malaysia" readonly autocomplete="fullname" autofocus>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="defaultpay" id="defaultpay" {{ old('defaultpay') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="defaultpay">
                                        {{ __('Set As Default') }}
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

    function showEXP() {
        var expireMM = document.getElementById('expireMM').value;
        var expireYY = document.getElementById('expireYY').value;
        var originalArray = [expireMM, expireYY]; 
        var separator = '/'; 
        var implodedArray = originalArray.join(separator); 
        document.getElementById('expdate').value=implodedArray; 
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
