<!DOCTYPE html>
<!--
Template Name: Tinker - HTML Admin Dashboard Template
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
        <link href="{{ asset('template/dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login - Admin</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('template/dist/css/app.css') }}" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- END: CSS Assets-->
        <style>
            .overlay {
                background: black;
                opacity: 50%;
                width: 62%;
            }
            .login::before {
                width: 75%;
                border-radius: 0;
                --tw-rotate: 0deg;
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
                background-image: url({{ asset('image/login/login.png') }});
            }
            .login::after {
                background: transparent;
            }
            @media screen and (max-width: 1279px) {
                .login {
                    background-position: center;
                    background-size: cover;
                    background-repeat: no-repeat;
                    background-image: url({{ asset('image/login/login.png') }});
                }
                .overlay {
                    background: black;
                    opacity: 50%;
                    width: 100%;
                }
            }
        </style>
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-3 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col col-span-2 min-h-screen">
                    <div class="my-auto text-white pt-80">
                        <div class="-intro-x font-medium text-4xl leading-tight mt-10">
                            Just a few more clicks to
                            <br>
                            sign in to your account.
                        </div>
                        {{-- <div class="-intro-x mt-5 text-lg">Manage all your e-commerce accounts in one place</div> --}}
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0 relative z-10">
                    <div class="my-auto mx-auto xl:ml-5 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <div class="-intro-x flex justify-center xl:justify-normal items-center pb-8 gap-3">
                            <img alt="" style="height: 100px" src="{{ asset('image/login/logo-1.png') }}">
                            <img alt="" style="height: 90px" src="{{ asset('image/login/logo-2.png') }}">
                        </div>
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Welcome Back, Admin!
                        </h2>
                        <form action="{{ route('admin.login.process') }}" id="login" method="POST">
                            @csrf
                            <div class="intro-x mt-8">
                                @if (session('error'))
                                    <x-alert-error message="{{ session('error') }}" />
                                @endif

                                <input type="text" name="email" autofocus class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="{{ old('email') }}" required>
                                <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" required>
                            </div>
                            <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                                <div class="flex items-center mr-auto">
                                    <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                    <label class="cursor-pointer select-none" for="remember-me">Remember me</label>
                                </div>
                                {{-- <a href="">Forgot Password?</a> --}}
                            </div>
                        </form>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button form="login" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                            {{-- <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Register</button> --}}
                        </div>
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <div class="overlay absolute h-full top-0 bottom-0 right-0 left-0 z-0"></div>
        <!-- BEGIN: Dark Mode Switcher-->
        {{-- <div data-url="login-dark-login.html" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
            <div class="mr-4 text-gray-700 dark:text-gray-300">Dark Mode</div>
            <div class="dark-mode-switcher__toggle border"></div>
        </div> --}}
        <!-- END: Dark Mode Switcher-->

        <!-- BEGIN: JS Assets-->
        <script src="{{ asset('template/dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->
    </body>
</html>
