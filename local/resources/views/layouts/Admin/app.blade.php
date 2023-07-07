
<!DOCTYPE html>
<html lang="th" class="light">

    <!-- BEGIN: Head -->
    <head>
        <head>
            <meta charset="utf-8">
            <link href="dist/images/logo.svg" rel="shortcut icon">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Enigma admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
            <meta name="keywords" content="admin template, Enigma Admin Template, dashboard template, flat admin template, responsive admin template, web app">
            <meta name="author" content="LEFT4CODE">
            {{-- <title>Bringme</title> --}}
            <title>@yield('title')</title>
            <!-- BEGIN: CSS Assets-->

            <link rel="stylesheet" href="{{asset('admin_st/dist/css/app.css')}}" />

            {{-- <script src="{{asset('admin_st/dist/js/app.js')}}" defer></script> --}}
            <link href='https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' rel='stylesheet'>
            <!-- END: CSS Assets-->

            <!-- BEGIN: JS Assets-->
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=[" your-google-map-api"]&libraries=places"></script>
            <script src="{{asset('admin_st/dist/js/ckeditor-classic.js')}}"></script>


            <!-- END: JS Assets-->
            @yield('css')
        </head>
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0">
        <!-- BEGIN: Mobile Menu -->
        @include('layouts.Admin.MobileMenu')
        <!-- END: Mobile Menu -->
        <!-- BEGIN: Top Bar -->

        @include('layouts.Admin.Topbar')
        <!-- END: Top Bar -->
        <div class="flex overflow-hidden">
            <!-- BEGIN: Side Menu -->

            @include('layouts.Admin.SideNav')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            @yield('content')

            <!-- END: Content -->
        </div>

        <script>
            $(document).ready(function() {
                $('a').removeClass('side-menu--active')
                $('ul').removeClass('side-menu__sub-open')
                $('a').each(function() {
                    let url = window.location.href;
                    let a = $(this).attr('href')
                    if (a == url) {
                        $(this).addClass('side-menu--active')
                        $(this).parent().parent().addClass('side-menu__sub-open')
                    }
                });

            });
        </script>
          <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
         @include('layouts.Admin.flash-message')
        @yield('js')


    </body>
</html>



