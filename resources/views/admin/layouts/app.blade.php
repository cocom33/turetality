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
        <title>@yield('title', 'Dashboard Admin') - Hotel</title>
        <!-- BEGIN: CSS Assets-->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ asset('template/dist/css/app.css') }}" />
        @stack('addon-style')
        <style>
            .link-paginate > nav > div {
                align-items: center;
                gap: 15px;
            }
        </style>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <!-- BEGIN: Mobile Menu -->
        @include('admin.layouts.sidebar-mobile')
        <!-- END: Mobile Menu -->
        <div class="flex mt-[4.7rem] md:mt-0 overflow-hidden">
            <!-- BEGIN: Side Menu -->
            @include('admin.layouts.sidebar')
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                @include('admin.layouts.navbar')
                <!-- END: Top Bar -->
                @yield('content')
            </div>
            <!-- END: Content -->
        </div>

        <!-- BEGIN: JS Assets-->
        {{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script> --}}
        <script src="{{ asset('template/dist/js/app.js') }}"></script>
        @stack('addon-script')
        <!-- END: JS Assets-->
    </body>
</html>
