@extends('layouts.staff-app')

@section('content')
<header>
        <h2>{{ __('Redemption Scanner') }}</h2>
        <p>Seamless food management for your children</p>
</header>
<div class="box">
                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <button class="button special fit small" onclick="scan()" >SCAN</button>
                        </div>
                    </div>

                    <div class="row gtr-50 gtr-uniform">
                        <div class="col-12">
                            <center>
                                <video id="preview" width="200" height="200"></video>
                            </center>
                        </div>
                    </div>

                   <!--  <p></p>
                    <center>
                        <h5>MANUAL ENTRY</h5>
                    </center> -->

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
                                <input id="studentid" type="text" class="form-control @error('studentid') is-invalid @enderror" name="studentid" value="{{ old('studentid') }}" required autocomplete="studentid" autofocus placeholder="Enter Student ID" readonly>

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

                    <!-- <div class="links">
                        <center>
                            <h5>Trial Scan</h5>
                            <br>
                            <video id="preview"></video>
                        </center>
                    </div> -->
</div>
<!-- <script type="text/javascript">
        var app = new Vue({
          el: '#app',
          data: {
            scanner: null,
            activeCameraId: null,
            cameras: [],
            scans: []
          },
          mounted: function () {
            var self = this;
            self.scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5 });
            self.scanner.addListener('scan', function (content, image) {
              self.scans.unshift({ date: +(Date.now()), content: content });
            });
            Instascan.Camera.getCameras().then(function (cameras) {
              self.cameras = cameras;
              if (cameras.length > 0) {
                self.activeCameraId = cameras[1].id;
                self.scanner.start(cameras[1]);
              } else {
                console.error('No cameras found.');
              }
            }).catch(function (e) {
              console.error(e);
            });
          },
          methods: {
            formatName: function (name) {
              return name || '(unknown)';
            },
            selectCamera: function (camera) {
              this.activeCameraId = camera.id;
              this.scanner.start(camera);
            }
          }
        });
</script> -->
<script type="text/javascript">
    // var Musique = new Audio();

    // function imprimer(){
    //     var partiImrimer = document.getElementById('qrcode');
    //     var newFenetre = window.open('','Print-Window');
    //     newFenetre.document.open();
    //     newFenetre.document.write('<html><body onload="window.print()">'+partiImrimer.innerHTML+'</body></html>');
    //     newFenetre.document.close();
    // }

    function scan(){
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        //console.log(scanner);
        scanner.addListener('scan', function (content) {
            console.log(content);
            if(content!=''){
                scanner.stop()
                document.getElementById('studentid').value=content; 
                // $.post('http://localhost:8000/api/scan',{data:content},function(response){
                //     if(response.info=='ok'){
                //         scanner.stop()
                //         $('#nbre').html(response.msg.nbre_visite)
                //         swal("Vous êtes autorisé à effectué votre visite", "OK !", "success");
                //         Musique.src = "/accesautoriser.wav";
                //         Musique.play();
                //     }
                //     else{
                //         swal("Vous n'êtes pas autorisé à effectué votre visite", "OK !", "error");
                //         Musique.src = "/accesrefuse.wav";
                //         Musique.play();
                //     }
                //     console.log(response.msg)
                // })
            }
        });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[1]);
            }
            else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
        });
    }
</script> 
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
