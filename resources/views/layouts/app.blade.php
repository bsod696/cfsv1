<!DOCTYPE HTML>
<!--
    Strongly Typed by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
         <title>{{ config('app.name', 'CanEat.') }}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    </head>
    <body class="homepage is-preload">
        <div id="page-wrapper">

            <!-- Header -->
                <section id="header">
                    <div class="container">

                        <!-- Logo -->
                            <h1 id="logo"><a href="{{url('/')}}">CanEat</a></h1>
                            <p>Eat Healthier, Reduce Food Waste.</p>

                        <!-- Nav -->
                            <nav id="nav">
                                <ul>
                                    <li><a class="icon solid fa-home" href="{{url('/')}}"><span>Home</span></a></li>
                                    <li>
                                        <a href="#" class="icon fa-chart-bar"><span>Dropdown</span></a>
                                        <ul>
                                            <li><a href="#">Lorem ipsum dolor</a></li>
                                            <li><a href="#">Magna phasellus</a></li>
                                            <li><a href="#">Etiam dolore nisl</a></li>
                                            <li>
                                                <a href="#">Phasellus consequat</a>
                                                <ul>
                                                    <li><a href="#">Magna phasellus</a></li>
                                                    <li><a href="#">Etiam dolore nisl</a></li>
                                                    <li><a href="#">Phasellus consequat</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Veroeros feugiat</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="icon solid fa-cog" href="left-sidebar.html"><span>Left Sidebar</span></a></li>
                                    <li><a class="icon solid fa-retweet" href="right-sidebar.html"><span>Right Sidebar</span></a></li>
                                    <li><a class="icon solid fa-sitemap" href="no-sidebar.html"><span>No Sidebar</span></a></li>
                                </ul>
                            </nav>

                    </div>
                </section>

            <!-- Main -->
                <section id="main">
                    <div class="container">
                        <div class="row">

                            <!-- Content -->
                                <div id="content" class="col-8 col-12-medium">

                                    
                                    @yield('content')
                                    

                                </div>

                                    <!-- Highlights -->
                                        <section>
                                            <ul class="divided">
                                                <li>

                                                    <!-- Highlight -->
                                                        <article class="box highlight">
                                                            <header>
                                                                <h3><a href="#">Something of note</a></h3>
                                                            </header>
                                                            <a href="#" class="image left"><img src="{{ asset('images/pic06.jpg') }}" alt="" /></a>
                                                            <p>Phasellus sed laoreet massa id justo mattis pharetra. Fusce suscipit ligula vel quam
                                                            viverra sit amet mollis tortor congue magna lorem ipsum dolor et quisque ut odio facilisis
                                                            convallis. Etiam non nunc vel est suscipit convallis non id orci. Ut interdum tempus
                                                            facilisis convallis. Etiam non nunc vel est suscipit convallis non id orci.</p>
                                                            <ul class="actions">
                                                                <li><a href="#" class="button icon solid fa-file">Learn More</a></li>
                                                            </ul>
                                                        </article>

                                                </li>
                                                <li>

                                                    <!-- Highlight -->
                                                        <article class="box highlight">
                                                            <header>
                                                                <h3><a href="#">Something of less note</a></h3>
                                                            </header>
                                                            <a href="#" class="image left"><img src="{{ asset('images/pic07.jpg') }}" alt="" /></a>
                                                            <p>Phasellus sed laoreet massa id justo mattis pharetra. Fusce suscipit ligula vel quam
                                                            viverra sit amet mollis tortor congue magna lorem ipsum dolor et quisque ut odio facilisis
                                                            convallis. Etiam non nunc vel est suscipit convallis non id orci. Ut interdum tempus
                                                            facilisis convallis. Etiam non nunc vel est suscipit convallis non id orci.</p>
                                                            <ul class="actions">
                                                                <li><a href="#" class="button icon solid fa-file">Learn More</a></li>
                                                            </ul>
                                                        </article>

                                                </li>
                                            </ul>
                                        </section>
                                </div>
                        </div>
                    </div>
                </section>

            <!-- Footer -->
                <section id="footer">
                    <div class="container">
                        <header>
                            <h2>Questions or comments? <strong>Get in touch:</strong></h2>
                        </header>
                        <div class="row">
                            <div class="col-6 col-12-medium">
                                <section>
                                    <form method="post" action="#">
                                        <div class="row gtr-50">
                                            <div class="col-6 col-12-small">
                                                <input name="name" placeholder="Name" type="text" />
                                            </div>
                                            <div class="col-6 col-12-small">
                                                <input name="email" placeholder="Email" type="text" />
                                            </div>
                                            <div class="col-12">
                                                <textarea name="message" placeholder="Message"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <a href="#" class="form-button-submit button icon solid fa-envelope">Send Message</a>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </div>
                            <div class="col-6 col-12-medium">
                                <section>
                                    <p>Erat lorem ipsum veroeros consequat magna tempus lorem ipsum consequat Phaselamet
                                    mollis tortor congue. Sed quis mauris sit amet magna accumsan tristique. Curabitur
                                    leo nibh, rutrum eu malesuada.</p>
                                    <div class="row">
                                        <div class="col-6 col-12-small">
                                            <ul class="icons">
                                                <li class="icon solid fa-home">
                                                    1234 Somewhere Road<br />
                                                    Nashville, TN 00000<br />
                                                    USA
                                                </li>
                                                <li class="icon solid fa-phone">
                                                    (000) 000-0000
                                                </li>
                                                <li class="icon solid fa-envelope">
                                                    <a href="#">info@untitled.tld</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-6 col-12-small">
                                            <ul class="icons">
                                                <li class="icon brands fa-twitter">
                                                    <a href="#">@untitled</a>
                                                </li>
                                                <li class="icon brands fa-instagram">
                                                    <a href="#">instagram.com/untitled</a>
                                                </li>
                                                <li class="icon brands fa-dribbble">
                                                    <a href="#">dribbble.com/untitled</a>
                                                </li>
                                                <li class="icon brands fa-facebook-f">
                                                    <a href="#">facebook.com/untitled</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div id="copyright" class="container">
                        <ul class="links">
                            <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                        </ul>
                    </div>
                </section>

        </div>

        <!-- Scripts -->
            <script src="{{ asset('js/jquery.min.js') }}"></script>
            <script src="{{ asset('js/jquery.dropotron.min.js') }}"></script>
            <script src="{{ asset('js/browser.min.js') }}"></script>
            <script src="{{ asset('js/breakpoints.min.js') }}"></script>
            <script src="{{ asset('js/util.js') }}"></script>
            <script src="{{ asset('js/main.js') }}"></script>

    </body>
</html>