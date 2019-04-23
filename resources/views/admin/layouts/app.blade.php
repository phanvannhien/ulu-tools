<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ url('favicon.ico') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/metisMenu.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/slicknav.min.css') }}">

    <!-- others css -->
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/typography.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/default-css.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ url('srtdash/assets/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ url('css/app.css') }}">
</head>

<body class="body-bg">
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- main wrapper start -->
    <div class="horizontal-main-wrapper">
        @include('admin.partials.main_header')
        @include('admin.partials.header_nav')

        <div class="main-content-inner mt-3">
            <div class="container">
                @include('admin.partials.messages')
                @yield('main')
            </div>
        </div>

        <!-- footer area start-->
        <footer>
            <div class="footer-area">
                <p>© Copyright {{ date('Y') }}. All right reserved.</p>
            </div>
        </footer>
        <!-- footer area end-->
    </div>
    <!-- main wrapper start -->


    <!-- jquery latest version -->
    <script src="{{ url('srtdash/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap 4 js -->
    <script src="{{ url('srtdash/assets/js/popper.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/metisMenu.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/jquery.slicknav.min.js') }}"></script>

    <!-- others plugins -->
    <script src="{{ url('srtdash/assets/js/plugins.js') }}"></script>
    <script src="{{ url('srtdash/assets/js/scripts.js') }}"></script>
    <script src="{{ url('js/app.js') }}"></script>

    @yield('footer')

</body>
</html>