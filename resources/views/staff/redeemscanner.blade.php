@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Redemption Scanner') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    <center>
                        <h5>SCAN QR CODE</h5>
                    </center>

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

                    <form action="{{ route('staff.submit.redeem') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row gtr-50 gtr-uniform">

                            <div class="col-12">
                                <input id="studentid" type="text" class="form-control @error('studentid') is-invalid @enderror" name="studentid" value="{{ old('studentid') }}" required autocomplete="studentid" autofocus placeholder="Enter Student ID">

                                    @error('studentid')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="col-12">
                                <ul class="actions special">
                                    <li>
                                        <input type="submit" value="{{ __('Redeem') }}"></input>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </form>

                    <div class="links">
                        <center>
                            <h5>Trial Scan</h5>
                            <br>
                            <video id="preview"></video>
                        </center>
                    </div>
</div> 
@endsection  
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
