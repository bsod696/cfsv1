<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.dropotron.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery.scrollex.min.js') }}" defer></script>
    <script src="{{ asset('js/browser.min.js') }}" defer></script>
    <script src="{{ asset('js/breakpoints.min.js') }}" defer></script>
    <script src="{{ asset('js/util.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
    <!-- <script src="{{ asset('js/zxing.js') }}" defer></script> -->
    <!-- <script src="{{ asset('js/camera.js') }}" defer></script> -->
    <!-- <script src="{{ asset('js/scanner.js') }}" defer></script> -->
    <!-- <script src="{{ asset('js/instascan.min.js') }}" defer></script> -->
    <!-- <script src="https://gist.githubusercontent.com/chris-gunawardena/15d507d11dc09ef8f7653f1005eda203/raw/9ee3e38c57f2b1b7dc034fcf4c0dc48a2126a67c/instascan.min.js" defer></script> -->

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/gh/schmich/instascan-builds@master/instascan.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script> 
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
    <!-- <script src="{{URL::to('/')}}/js/instascan.min.js"></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="is-preload">
    <div id="page-wrapper">

        <!-- Header -->
                <header id="header">
                    <h1><a href="{{ url('/staff/dashboard') }}">Canteen Food System</a> (CFS)</h1>
                    <nav id="nav">
                        <ul>
                            <li><a href="{{ url('/staff/dashboard') }}">Home</a></li>
                            <li>
                                <a href="" class="icon solid fa-angle-down">{{ Auth::guard('staff')->user()->username }}</a>
                                <ul>
                                    <li><a href="{{ route('staff.dashboard') }}">Home</a></li>
                                    <li>
                                        <a href="{{ route('staff.redeem') }}">
                                            Scanner
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Setting</a>
                                        <ul>
                                            <li><a href="{{ route('staff.editstaff') }}">Edit Personal Details</a></li>
                                            <li><a href="{{ route('staff.password') }}">Change Password</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('staff.logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="button"
                                >
                                Logout
                                </a>

                                <form id="logout-form" action="{{ route('staff.logout') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                </header>

        <!-- Main -->
                <section id="main" class="container">
                    @yield('content')
                </section>

        <!-- Footer -->
                <footer id="footer">
                    <ul class="icons">
                        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon brands fa-github"><span class="label">Github</span></a></li>
                        <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
                        <li><a href="#" class="icon brands fa-google-plus"><span class="label">Google+</span></a></li>
                    </ul>
                    <ul class="copyright">
                        <li>&copy; CFS. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    </ul>
                </footer>
    </div>
</body>
</html>
