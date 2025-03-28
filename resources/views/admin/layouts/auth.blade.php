<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Stylesheets --}}
    {{-- Title --}}
    <title>Admin Panel </title>

    {{-- Script --}}


    {{-- new css --}}
    <link href="{{ asset('admin_new/vendor/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_new/css/style.css') }}" rel="stylesheet">

    @yield('css')

</head>

<body>
    @yield('auth-card')

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{ asset('admin_new/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('admin_new/vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/custom.min.js') }}"></script>
    <script src="{{ asset('admin_new/js/dlabnav-init.js') }}"></script>


</body>

</html>
