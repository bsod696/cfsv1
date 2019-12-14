@extends('layouts.admin-app')

@section('content')
<header>
        @foreach( $updata as $u)
        <h2>{{ __('Edit Menu Image : ') }} {{ $u->menuname }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
    @include('flash-message')
                    <form method="POST" action="{{ route('admin.submit.editmenuimage') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="foodname" type="hidden" class="form-control @error('foodname') is-invalid @enderror" name="foodname" value="{{ $u->menuname }}" required autocomplete="id" readonly>

                        <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $u->id }}" required autocomplete="id" readonly>

                        <div class="row gtr-50 gtr-uniform">
                           
                            <div class="col-12">
                                <label for="foodpic" class="col-md-4 col-form-label text-md-right">{{ __('Menu Picture') }}</label>
                                <input id="foodpic" type="file" class="form-control{{ $errors->has('foodpic') ? ' is-invalid' : '' }}" name="foodpic" value="{{ $u->menupic }}" required autocomplete="foodpic" autofocus onchange="readURLfoodpic(this);">
                                
                                @if ($errors->has('foodpic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foodpic') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-12">
                                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                                <img id="foodp" src="{{ asset($u->menupic) }}" alt="your image" width="240" height="160" border="1"/>
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
