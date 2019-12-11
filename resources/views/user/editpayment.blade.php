@extends('layouts.user-app')

@section('content')
<header>
        <h2>{{ __('Edit Payment Details') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach( $updata as $u)
                    <form method="POST" action="{{ route('user.submit.editpayment') }}">
                        @csrf

                        <input id="id" type="hidden" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id"  value="{{ $u->id }}" hidden />
                        <input id="parentid" type="hidden" class="form-control @error('parentid') is-invalid @enderror" name="parentid" value="{{ $u->parentid }}" readonly hidden>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Credit Card Info</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">

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
                                <label for="cardtype" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Type') }}</label>
                                <input id="cardtype" type="text" class="form-control @error('cardtype') is-invalid @enderror" name="cardtype" value="{{ strtoupper($u->cardtype) }}" readonly autocomplete="cardtype" autofocus>
                                <!-- <select id="cardtype" class="form-control{{ $errors->has('cardtype') ? ' is-invalid' : '' }}" name="cardtype" required autofocus>
                                    <option value="{{ ucfirst($u->cardtype) }}">{{ ucfirst($u->cardtype) }}</option>
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Mastercard</option>
                                </select> -->
                                    
                                @if ($errors->has('cardtype'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cardtype') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="cardnum" class="col-md-4 col-form-label text-md-right">{{ __('Credit Card Number') }}</label>
                                <input id="cardnum" type="text" class="form-control @error('cardnum') is-invalid @enderror" name="cardnum" value="{{ $u->cardnum }}" readonly autocomplete="cardnum" autofocus>

                                @error('cardnum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="cvvnum" class="col-md-4 col-form-label text-md-right">{{ __('CVV Number') }}</label>
                                <input id="cvvnum" type="text" maxlength="3" class="form-control @error('cvvnum') is-invalid @enderror" name="cvvnum" value="{{ $u->cvvnum }}" readonly autocomplete="cvvnum" autofocus>

                                @error('cvvnum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <label for="expdate" class="col-md-4 col-form-label text-md-right">{{ __('Expiration Date') }}</label>
                               <!--  <select name='expireMM' id='expireMM' class="form-control{{ $errors->has('expireMM') ? ' is-invalid' : '' }}" required autofocus>
                                    
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
                            </div>

                        </div>

                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-6 col-12-mobilep">
                                <select name='expireYY' id='expireYY' class="form-control{{ $errors->has('expireYY') ? ' is-invalid' : '' }}" required autofocus onchange="showEXP()">
                                    
                                    <option value=''>Year</option>
                                    <option value='19'>2019</option>
                                    <option value='20'>2020</option>
                                    <option value='21'>2021</option>
                                    <option value='22'>2022</option>
                                    <option value='23'>2023</option>
                                    <option value='24'>2024</option>
                                    <option value='25'>2025</option>
                                </select>  -->
                                <input type="text" id="expdate" class="form-control{{ $errors->has('expdate') ? ' is-invalid' : '' }}" name="expdate" min="2019-01-01" readonly autofocus value="{{ $u->expdate }}">
                                    
                                @if ($errors->has('expdate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('expdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <p></p>
                        <div class="row gtr-50 gtr-uniform">
                            <p><b>Billing Address</b></p>
                        </div>

                        <div class="row gtr-50 gtr-uniform">
                        
                            <div class="col-6 col-12-mobilep">
                                <label for="billaddr1" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 1') }}</label>
                                <input id="billaddr1" type="text" class="form-control @error('billaddr1') is-invalid @enderror" name="billaddr1" value="{{ $u->billaddr1 }}" required autocomplete="billaddr1" autofocus>

                                @error('billaddr1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="billaddr2" class="col-md-4 col-form-label text-md-right">{{ __('Address Line 2') }}</label>
                                <input id="billaddr2" type="text" class="form-control @error('billaddr2') is-invalid @enderror" name="billaddr2" value="{{ $u->billaddr2 }}" required autocomplete="billaddr2" autofocus>

                                @error('billaddr2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $u->city }}" required autocomplete="city" autofocus>

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="zipcode" class="col-md-4 col-form-label text-md-right">{{ __('Zipcode') }}</label>
                                <input id="zipcode" type="text" maxlength="5" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ $u->zipcode }}" required autocomplete="zipcode" autofocus>

                                @error('zipcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-6 col-12-mobilep">
                                <label for="state" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
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

                            <div class="col-6 col-12-mobilep">
                                <label for="country" class="col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>
                                <input id="country" type="text" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ $u->country }}" readonly autocomplete="fullname" autofocus>

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
                                    <input class="form-check-input" type="checkbox" name="defaultpay" id="defaultpay" {{ $u->defaultpay == 'Y' ? 'checked' : '' }} value="defaultpay">

                                    <label class="form-check-label" for="defaultpay">
                                        {{ __('Set As Default') }}
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
