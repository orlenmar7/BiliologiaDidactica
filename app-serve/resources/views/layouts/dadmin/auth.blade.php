<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-outlines">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ==== Document Title ==== -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="{{ asset('assets/dadmin/favicon.png') }}" type="image/png">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/perfect-scrollbar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/morris.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/jquery-jvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/horizontal-timeline.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/ion.rangeSlider.skinFlat.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dadmin/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}"/>

</head>
<body>

    <!-- Wrapper Start -->
    <div class="wrapper" id="app">
        <!-- Login Page Start -->
        <div class="m-account-w" data-bg-img="{{ asset('assets/dadmin/assets/img/account/wrapper-bg.jpg') }}">
            <div class="m-account">

                @yield('content')

            </div>
        </div>
        <!-- Login Page End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="{{ asset('assets/dadmin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/perfect-scrollbar.min.js') }} "></script>
    <script src="{{ asset('assets/dadmin/assets/js/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/jquery-jvectormap-world-mill.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/horizontal-timeline.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/ion.rangeSlider.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/dadmin/assets/js/main.js') }}"></script>

    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- notificacione swal --}}
    @include('sweetalert::alert')

    <!-- Page Level Scripts -->

</body>
</html>
