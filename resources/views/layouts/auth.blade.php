<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ url('favicon.ico') }}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('auth/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('auth/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('auth/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('auth/css/main.css') }}">
    <!--===============================================================================================-->
</head>
<body>

    @yield('main')

    <!--===============================================================================================-->
    <script src="{{ url('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('auth/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('auth/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ url('auth/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script >
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ url('auth/js/main.js') }}"></script>

</body>
</html>