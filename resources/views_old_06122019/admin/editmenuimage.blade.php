@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @foreach( $updata as $u)
                <div class="card-header">{{ __('Edit Menu Image for : ') }} <b>{{ $u->menuname }}</b> </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    
                    <form method="POST" action="{{ route('admin.submit.editmenuimage') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="menuname" type="hidden" class="form-control @error('menuname') is-invalid @enderror" name="menuname" value="{{ $u->menuname }}" required autocomplete="id" readonly>

                        <input id="id" type="hidden" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $u->id }}" required autocomplete="id" readonly>

                        <div class="form-group row">
                            <label for="foodpic" class="col-md-4 col-form-label text-md-right">{{ __('Menu Picture') }}</label>

                            <div class="col-md-6">
                                <input id="foodpic" type="file" class="form-control{{ $errors->has('foodpic') ? ' is-invalid' : '' }}" name="foodpic" value="{{ $u->menupic }}" required autocomplete="foodpic" autofocus onchange="readURLfoodpic(this);">
                                
                                @if ($errors->has('foodpic'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('foodpic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>

                            <div class="col-md-6">
                                <img id="foodp" src="{{ asset($u->menupic) }}" alt="your image" width="240" height="160" border="1"/>
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
