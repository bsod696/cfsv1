@extends('layouts.staff-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Redemption Scanner</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (!empty($message))
                        <div class="alert alert-success" role="alert">
                            {{ $message }}
                        </div>
                    @endif

                    <div class="links">
                        <center>
                            <h5>SCAN QR CODE</h5>
                            <br>
                            <video id="preview"></video>

                            <!-- <script type="text/javascript">
                                alert('lololololol');
                            </script> -->

                            <form action="{{ route('staff.submit.redeem') }}" method="POST" enctype="multipart/form-data">
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

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Redeem') }}
                                        </button>
                                    </div>
                                </div>
                            </form>   
                            <!-- <script type="text/javascript">
                                // const Instascan = require('instascan');
                                let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                                scanner.addListener('scan', function (content) {
                                    console.log(content);
                                });
                                Instascan.Camera.getCameras().then(function (cameras) {
                                    if (cameras.length > 0) {
                                        scanner.start(cameras[0]);
                                    } else {
                                        console.error('No cameras found.');
                                    }
                                }).catch(function (e) {
                                    console.error(e);
                                });
                            </script> -->
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
