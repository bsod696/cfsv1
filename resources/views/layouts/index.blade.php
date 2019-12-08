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

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body class="landing is-preload">
    <!-- <div id="app"> -->
    <div id="page-wrapper">
        <!-- Header -->
                <header id="header" class="alt">
                    <h1><a href="{{ url('/') }}">Canteen Food System</a> (CFS)</h1>
                    <nav id="nav">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li>
                                <a href="" class="icon solid fa-angle-down">Not a Parent ?</a>
                                <ul>
                                    <li><a href="{{ route('staff.login') }}">Staff Access</a></li>
                                    <li><a href="{{ route('admin.login') }}">Admin Access</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('user.register') }}" class="button">Sign Up</a></li>
                        </ul>
                    </nav>
                </header>

            <!-- Banner -->
                <section id="banner">
                    <h2>Canteen Food System</h2>
                    <p>Seamless food management for your children.</p>
                    <ul class="actions special">
                        <li><a href="{{ route('user.register') }}" class="button primary">Sign Up</a></li>
                        <li><a href="{{ route('user.login') }}" class="button">Sign In</a></li>
                    </ul>
                </section>

            <!-- Main -->
                <section id="main" class="container">
                    @yield('content')
                </section>

            <!-- CTA -->
               <!--  <section id="cta">

                    <h2>Sign up for beta access</h2>
                    <p>Blandit varius ut praesent nascetur eu penatibus nisi risus faucibus nunc.</p>

                    <form>
                        <div class="row gtr-50 gtr-uniform">
                            <div class="col-8 col-12-mobilep">
                                <input type="email" name="email" id="email" placeholder="Email Address" />
                            </div>
                            <div class="col-4 col-12-mobilep">
                                <input type="submit" value="Sign Up" class="fit" />
                            </div>
                        </div>
                    </form>

                </section> -->

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
