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
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"/> -->
    <!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"/> -->
    <!-- <script src="http://multidatespickr.sourceforge.net/jquery-ui.multidatespicker.js"/> -->

    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"/> -->
    <!-- <script type="text/javascript" src="{{ asset('js/jquerydate.min.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('js/jquery-ui.js') }}"/></script>    -->
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"/> -->
    <!-- <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"/> -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"> -->
    <!-- <link href="{{ asset('css/jquery-ui.multidatespicker.css') }}" rel="stylesheet"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css"> -->
</head>
<body class="is-preload">
    <div id="page-wrapper">

        <!-- Header -->
                <header id="header">
                    <h1><a href="{{ url('/user/home') }}">Canteen Food System</a> (CFS)</h1>
                    <nav id="nav">
                        <ul>
                            <li><a href="{{ url('/user/home') }}">Home</a></li>
                            <li>
                                <a href="" class="icon solid fa-angle-down">{{ Auth::user()->username }}</a>
                                <ul>
                                    <li><a href="{{ route('user.home') }}">Home</a></li>
                                    <li>
                                        <a href="{{ route('user.vieworder') }}">
                                            Cart
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Setting</a>
                                        <ul>
                                            <li><a href="{{ route('user.editparent') }}">Edit Personal Details</a></li>
                                            <li><a href="{{ route('user.password') }}">Change Password</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('user.logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="button"
                                >
                                Logout
                                </a>

                                <form id="logout-form" action="{{ route('user.logout') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                </header>

        <!-- Main -->
                <section id="main" class="container">
                    <header>
                        <h2>{{ __('Student Menus') }}</h2>
                        <p>Seamless food management for your children</p>
                    </header>
                    <div class="box">
                        @include('flash-message')
                        <!-- <div id="page">
                                <h1 id="mdp-title">MultiDatesPicker <span class="mdp-version"></span> for jQuery UI</h1>
                                <tr>
                                    <td>Date:</td>
                                    <td>
                                        <li class='demo'>
                                            <div class='box'>
                                                <div id="date" class="datepicker" style="display:block;"></div>
                                            </div>
                                            <script type="text/javascript">
                                                $(document).ready(function(){
                                                $("#date").multiDatesPicker();
                                                });
                                            </script>
                                        </li>
                                    </td>
                                </tr>
                            </div> -->
                        
                        <!-- <input type="button" value="Répercuter" class="button" id="btnRepercute"/>
                        <input type="text" id="date" class="hidden" />
                        <script type="text/javascript"> 
                            $(document).ready(function(){
                                $("#date").multiDatesPicker();
                                $("#btnRepercute").click(function () {
                                    $("#date").multiDatesPicker("show");
                                });
                            });        
                        </script> -->

                        <!-- <div mbsc-form>
                            <div class="mbsc-grid">
                                <div class="mbsc-row">
                                    <div class="mbsc-col-sm-12 mbsc-col-md-4">
                                        <div class="mbsc-form-group">
                                            <div class="mbsc-form-group-title">Multi-day</div>
                                            <div id="demo-multi-day"></div>
                                        </div>
                                    </div>
                                    <div class="mbsc-col-sm-12 mbsc-col-md-4">
                                        <div class="mbsc-form-group">
                                            <div class="mbsc-form-group-title">Max days</div>
                                            <div id="demo-max-days"></div>
                                        </div>
                                    </div>
                                    <div class="mbsc-col-sm-12 mbsc-col-md-4">
                                        <div class="mbsc-form-group">
                                            <div class="mbsc-form-group-title">Counter</div>
                                            <div id="demo-counter"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript"> 
                            $(document).ready(function(){
                                mobiscroll.settings = {
                                    theme: 'ios',
                                    themeVariant: 'light'
                                };

                                $(function () {

                                    $('#demo-multi-day').mobiscroll().calendar({
                                        display: 'inline',
                                        select: 'multiple'
                                    });

                                    $('#demo-max-days').mobiscroll().calendar({
                                        display: 'inline',
                                        select: 5,
                                        headerText: 'Pick up to 5 days'
                                    });

                                    $('#demo-counter').mobiscroll().calendar({
                                        display: 'inline',
                                        select: 'multiple',
                                        counter: true
                                    });

                                });
                            });        
                        </script> -->

                        <!-- <div id="from--input" class="box"><input id="from-input" type="text" /></div>
                        <script type="text/javascript"> 
                            $(document).ready(function(){
                                var today = new Date();  
                                $.ajax({
                                    url: "/httphandler/GestionDates",
                                    success: function (data) {
                                        var tabl = data.PPGDates;
                                        var tabl2 = data.FormDates;
                                        var tab = tabl.concat(tabl2);
                                        $('#from-input').multiDatesPicker({
                                            addDisabledDates: [tab],
                                            defaultDate: today,
                                            beforeShowDay: $.datepicker.noWeekends,
                                            minDate: 0
                                        });
                                    }
                                });
                            });        
                        </script> -->

                       

                        <div id="datepicker"></div> 
                        <script type="text/javascript">
                            $(document).ready(function(){
                               $('#datepicker').datepicker();
                            });
                        </script>    
                    </div>
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
