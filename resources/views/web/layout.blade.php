<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>SkillsHub - @yield('title')</title>

    @if (App::getLocale() == 'ar')
        <style>
            html {
                direction: rtl;
            }

        </style>
    @else
        <style>
            html {
                direction: ltr;
            }

        </style>
    @endif
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/bootstrap.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('web/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/style.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('web/css/toastr.min.css') }}" />
    @yield('styles')

    <style>
        input:checked~.checkmark:after {
            background-color: #FF6700;
        }

    </style>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>

<body>

    <!-- Header -->
    <header id="header">
        <div class="container">

            <div class="navbar-header">
                <!-- Logo -->
                <div class="navbar-brand">
                    <a class="logo" href="{{ url('/') }}">
                        <img src="{{ asset('web/img/logo.png') }}" alt="logo">
                    </a>
                </div>
                <!-- /Logo -->

                <!-- Mobile toggle -->
                <button class="navbar-toggle">
                    <span></span>
                </button>
                <!-- /Mobile toggle -->
            </div>

            <!-- Navigation -->
            <x-navbar></x-navbar>
            <!-- /Navigation -->
        </div>
    </header>
    <!-- /Header -->
    @yield('main')

    <!-- Footer -->
    <footer id="footer" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div id="bottom-footer" class="row">

                <!-- social -->
                <x-social-links></x-social-links>
                <!-- /social -->

                <!-- copyright -->
                <div class="col-md-8 col-md-pull-4">
                    <div class="footer-copyright">
                        <span>&copy; Copyright 2021. All Rights Reserved. | Made with <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="#">SkillsHub</a></span>
                    </div>
                </div>
                <!-- /copyright -->

            </div>
            <!-- row -->

        </div>
        <!-- /container -->

    </footer>
    <!-- /Footer -->

    <!-- preloader -->
    <div id='preloader'>
        <div class='preloader'></div>
    </div>
    <!-- /preloader -->


    <!-- jQuery Plugins -->
    <script type="text/javascript" src="{{ asset('web/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/jquery.nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('web/js/toastr.min.js') }}"></script>
    <script>
        (() => {
            let x = window.matchMedia("(min-width: 1200px)");
            if (x.matches) {
                $("html").niceScroll({
                    cursorcolor: "#FF6700",
                    cursorwidth: "6px",
                    railpadding: {
                        top: 10,
                        right: 5,
                        left: 5,
                        bottom: 10
                    },
                });
            }
        })();
    </script>
    <script>
        $("#logout-link").click(function(e) {
            e.preventDefault();
            $("#logout-form").submit();
        });
    </script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        let pusher = new Pusher('29c3cfe554aee829628f', {
            cluster: 'eu'
        });

        let notifications = pusher.subscribe('notifications-channel');
        notifications.bind('exam-added', function(data) {
            toastr.success(data.message);
        });
        notifications.bind('skill-added', function(data) {
            toastr.success(data.message);
        });
        notifications.bind('cat-added', function(data) {
            toastr.success(data.message);
        });

        //---------------------------------------

        notifications.bind('exam-deleted', function(data) {
            toastr.error(data.message);
        });
        notifications.bind('skill-deleted', function(data) {
            toastr.error(data.message);
        });
        notifications.bind('cat-deleted', function(data) {
            toastr.error(data.message);
        });

        //-----------------------------------------

        notifications.bind('exam-toggled', function(data) {
            toastr.warning(data.message);
        });
        notifications.bind('skill-toggled', function(data) {
            toastr.warning(data.message);
        });
        notifications.bind('cat-toggled', function(data) {
            toastr.warning(data.message);
        });
    </script>
    @yield('scripts')
</body>

</html>
