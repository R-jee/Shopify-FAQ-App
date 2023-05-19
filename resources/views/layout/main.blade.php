<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>FAST FAQ Shopify | Dashboard</title>

    <!-- CSRF Token -->
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    <title>{{ \Osiset\ShopifyApp\Util::getShopifyConfig('app_name') }}</title>--}}

    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('assets/vendors/font-awesome/fontawesome6/css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendor.css') }}" rel="stylesheet" />
    <!-- GLOBAL MAINLY STYLES-->
    <link rel="stylesheet" href="https://unpkg.com/@shopify/polaris@10.49.1/build/esm/styles.css" />
    <link href="{{ asset('assets/vendors/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    {{--    <link href="https://unpkg.com/tailwindcss@0.7.4/dist/tailwind.min.css" rel="stylesheet" >--}}
    <link href="{{ asset('assets/vendors/themify-icons/css/themify-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/animate.css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/toastr/toastr.min.css') }}" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet" />

</head>


<body class="fixed-navbar" style="padding-top:0px;">
    @if(\Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_enabled'))
        <script src="https://unpkg.com/@shopify/app-bridge{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script src="https://unpkg.com/@shopify/app-bridge-utils{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>
        <script
                @if(\Osiset\ShopifyApp\Util::getShopifyConfig('turbo_enabled'))
                    data-turbolinks-eval="false"
                @endif
        >
                var AppBridge = window['app-bridge'];
                var actions = AppBridge.actions;
                var utils = window['app-bridge-utils'];
                var createApp = AppBridge.default;
                var app = createApp({
                    apiKey: "{{ \Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name ) }}",
                    shopOrigin: "{{ $shopDomain ?? Auth::user()->name }}",
                    host: "{{ \Request::get('host') }}",
                    forceRedirect: true,
                });
        </script>

        @include('shopify-app::partials.token_handler')
        @include('shopify-app::partials.flash_messages')
    @endif

    <div class="page-wrapper">
        <!-- START HEADER-->
            {{--    @include('layout.partials.header')--}}
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
            {{--    @include('layout.partials.nav')--}}
        <!-- END SIDEBAR-->
        <div class="content-wrapper" style="margin-left:0px; padding-top:0px;">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                @yield('content')
            </div>
            <!-- END PAGE CONTENT-->
            @include('layout.partials.footer')
        </div>
    </div>

    <!-- BEGIN PAGA BACKDROPS-->
    {{--<div class="sidenav-backdrop backdrop"></div>--}}
    <div class="preloader-backdrop">
        @include('layout.partials.preload')
    </div>
    <!-- END PAGA BACKDROPS-->

    <!-- CORE PLUGINS-->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="{{ asset('assets/vendor.js') }}" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js" async defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js" async defer></script>
    <script src="{{ asset('assets/vendors/metisMenu/dist/metisMenu.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/jquery-idletimer/dist/idle-timer.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/toastr/toastr.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/jquery-validation/dist/jquery.validate.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/dist/js/bootstrap-select.min.js') }}" async defer></script>
    <script src="https://cdn.tailwindcss.com/3.3.1" async defer></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="{{ asset('assets/vendors/chart.js/dist/Chart.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" async defer></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}" async defer></script>
    <!-- CORE SCRIPTS-->
    <script src="{{ asset('assets/js/app.min.js') }}" async defer></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('assets/vendors/font-awesome/fontawesome6/js/all.min.js') }}" async defer></script>

    @yield('scripts')
</body>
</html>
