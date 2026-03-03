<!DOCTYPE html>
<html lang="en">
    @include('frontend.partials.head')
    <body class="header-fixed page no-sidebar header-style-1 topbar-style-1 menu-has-search counter-scroll">
        <div id="loading-overlay">
            <div class="loader"></div>
        </div>

        <div id="wrapper" class="animsition">
            <div id="page" class="clearfix">
                @include('frontend.partials.header')

                @yield('content')

                @include('frontend.partials.footer')
            </div>
        </div>

        @include('sweetalert::alert')
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    </body>

</html>
