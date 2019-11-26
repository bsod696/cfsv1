@extends('layouts.user-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Payment Details') }}</div>

                <div class="card-body">
                    @foreach( $updata as $u)
                    <form method="POST" action="{{ route('user.submit.editpayment') }}">
                        @csrf
                        <input id="id" type="text" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />
                        <input id="parentid" type="text" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ $u->parentid }}" readonly hidden>
                        <input id="fullname" type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" value="{{ $u->fullname }}" readonly hidden>

                        <p><b>Credit Card Info</b></p>
                        <div class="form-group row">
                            <label for="cardtype" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Type') }}</label>

                            <div class="col-md-6">
                                <select id="cardtype" class="form-control{{ $errors->has('cardtype') ? ' is-invalid' : '' }}" name="cardtype" required autofocus>
                                    <option value="{{ ucfirst($u->cardtype) }}">{{ ucfirst($u->cardtype) }}</option>
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Mastercard</option>
                                </select>
                                    
                                @if ($errors->has('cardtype'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cardtype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cardnum" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Number') }}</label>

                            <div class="col-md-6">
                                <input id="cardnum" type="text" class="form-control @error('cardnum') is-invalid @enderror" name="cardnum" value="{{ $u->cardnum }}" required autocomplete="cardnum" autofocus>

                                @error('cardnum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="cvvnum" class="col-md-4 col-form-label text-md-right">{{ __('CVV Number') }}</label>

                            <div class="col-md-6">
                                <input id="cvvnum" type="text" maxlength="3" class="form-control @error('cvvnum') is-invalid @enderror" name="cvvnum" value="{{ $u->cvvnum }}" required autocomplete="cvvnum" autofocus>

                                @error('cvvnum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expdate" class="col-md-4 col-form-label text-md-right">{{ __('Expiration Date') }}</label>

                            <div class="col-md-6">  
                                <select name='expireMM' id='expireMM' class="form-control{{ $errors->has('cardtype') ? ' is-invalid' : '' }}" required autofocus>
                                    <!-- <option value='{{ explode("/",$u->expdate)[0] }}'>{{ explode("/",$u->expdate)[0] }}</option> -->
                                    <option value=''>Month</option>
                                    <option value='01'>January</option>
                                    <option value='02'>February</option>
                                    <option value='03'>March</option>
                                    <option value='04'>April</option>
                                    <option value='05'>May</option>
                                    <option value='06'>June</option>
                                    <option value='07'>July</option>
                                    <option value='08'>August</option>
                                    <option value='09'>September</option>
                                    <option value='10'>October</option>
                                    <option value='11'>November</option>
                                    <option value='12'>December</option>
                                </select> 
                                <select name='expireYY' id='expireYY' class="form-control{{ $errors->has('cardtype') ? ' is-invalid' : '' }}" required autofocus onchange="showEXP()">
                                    <!-- <option value='{{ explode("/",$u->expdate)[1] }}'>{{ explode("/",$u->expdate)[1] }}</option> -->
                                    <option value=''>Year</option>
                                    <option value='19'>2019</option>
                                    <option value='20'>2020</option>
                                    <option value='21'>2021</option>
                                    <option value='22'>2022</option>
                                    <option value='23'>2023</option>
                                    <option value='24'>2024</option>
                                    <option value='25'>2025</option>
                                </select> 
                                <input type="text" id="expdate" class="form-control{{ $errors->has('expdate') ? ' is-invalid' : '' }}" name="expdate" min="2019-01-01" readonly autofocus value>
                                    
                                @if ($errors->has('expdate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <p><b>Billing Address</b></p>
                        <div class="form-group row">
                            <label for="billaddr1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>

                            <div class="col-md-6">
                                <input id="billaddr1" type="text" class="form-control @error('billaddr1') is-invalid @enderror" name="billaddr1" value="{{ $u->billaddr1 }}" required autocomplete="billaddr1" autofocus>

                                @error('billaddr1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="billaddr2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>

                            <div class="col-md-6">
                                <input id="billaddr2" type="text" class="form-control @error('billaddr2') is-invalid @enderror" name="billaddr2" value="{{ $u->billaddr2 }}" required autocomplete="billaddr2" autofocus>

                                @error('billaddr2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $u->city }}" required autocomplete="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('Zipcode') }}</label>

                            <div class="col-md-6">
                                <input id="zipcode" type="text" maxlength="5" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ $u->zipcode }}" required autocomplete="zipcode" autofocus>

                                @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                            <div class="col-md-6">
                                <select id="state" class="form-control{{ $errors->has('state') ? ' is-invalid' : '' }}" name="state" required autofocus>
                                    <option value="{{ $u->state }}">{{ $u->state }}</option>
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
                        </div>

                        <div class="form-group row">
                            <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $u->country }}" readonly autocomplete="fullname" autofocus>

                                @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="defaultpay" id="defaultpay" {{ $u->defaultpay == 'Y' ? 'checked' : '' }} value="defaultpay">

                                    <label class="form-check-label" for="defaultpay">
                                        {{ __('Set As Default') }}
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
