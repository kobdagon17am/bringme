<!DOCTYPE html>
<html lang="th" class="light">

    <!-- BEGIN: Head -->
    <head>
        <head>
            <meta charset="utf-8">
            <link href="{{asset('frontend/dist/images/logo.svg')}}" rel="shortcut icon">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Enigma admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
            <meta name="keywords" content="admin template, Enigma Admin Template, dashboard template, flat admin template, responsive admin template, web app">
            <meta name="author" content="LEFT4CODE">
            {{-- <title>Bringme</title> --}}
            <title>@yield('title')</title>
            <!-- BEGIN: CSS Assets-->



            <link rel="stylesheet" href="{{asset('frontend/dist/css/app.css')}}" />
           <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

            <link href='//cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css' rel='stylesheet'>


            <script defer src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
            <script defer src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
            <script defer src="{{asset('frontend/dist/js/ckeditor-classic.js')}}"></script>
            <!-- END: JS Assets-->


            @yield('css')
        </head>
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0">
        <!-- BEGIN: Mobile Menu -->
        @include('layouts.frontend.MobileMenu')
        <!-- END: Mobile Menu -->
        <!-- BEGIN: Top Bar -->

        @include('layouts.frontend.Topbar')
        <!-- END: Top Bar -->
        <div class="flex overflow-hidden">
            <!-- BEGIN: Side Menu -->

            @include('layouts.frontend.SideNav')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            @yield('content')

            <!-- END: Content -->
        </div>
        <script src="{{ asset('frontend/dist/js/app.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

       <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
       @include('layouts.backend.flash-message')

        @yield('js')
    </body>
</html>



