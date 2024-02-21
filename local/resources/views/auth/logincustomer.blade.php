<!DOCTYPE html>
<!--
Template Name: Enigma - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{asset('frontend/dist/images/logo-bringMe.png')}}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="appbefriends">
    <meta name="keywords" content="appbefriends">
    <meta name="author" content="LEFT4CODE">
    <title>AppBringme</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ asset('frontend/dist/css/app.css') }}" />
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="bg-white">
    <!-- <div class="container sm:px-10"> -->
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->


            <div class="hidden xl:flex flex-col min-h-screen">
                <img alt="Midone - HTML Admin Template" class="w-11/12 xl:w-9/12 xl:h-screen" src="{{ asset('frontend/dist/images/BringMe_Web_Seller_BG_LOGIN_.png') }}">
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->

            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">

                <div class="my-auto mx-auto xl:mx-0 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left text-[#fefefe]">
                        Sign In
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">A few more clicks to sign in to
                        your account. Manage all your e-commerce accounts in one place</div>
                    <form method="POST" action="{{ route('customer_login') }}">
                        @csrf
                        <div class="intro-x mt-8">
                            <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} intro-x login__input form-control py-3 px-4 block rounded-full" name="email" value="{{ old('email') }}" id="text" placeholder="email" aria-label="Email" aria-describedby="basic-addon1" required autofocus>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <input type="password" id="password" name="password" placeholder="password" aria-label="Password" aria-describedby="basic-addon1" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} intro-x login__input form-control py-3 px-4 block mt-4 rounded-full" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        {{-- <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                            </div>
                            <a href="">Forgot Password?</a>
                        </div> --}}
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top rounded-full">Login</button>
                            {{-- <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</button> --}}
                        </div>
                        <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">
                            By signin up, you agree to our <a class="text-primary dark:text-slate-200" href="">Terms
                                and Conditions</a> & <a class="text-primary dark:text-slate-200" href="">Privacy
                                Policy</a> </div>
                    </form>
                </div>

            </div>
            <!-- END: Login Form -->

        </div>
    <!-- </div> -->
    <!-- BEGIN: Dark Mode Switcher-->
    {{-- <div data-url="login-dark-login.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div> --}}
    <!-- END: Dark Mode Switcher-->

    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('backend/dist/js/app.js') }}"></script>
    <!-- END: JS Assets-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    @include('layouts.backend.flash-message')
</body>

</html>


