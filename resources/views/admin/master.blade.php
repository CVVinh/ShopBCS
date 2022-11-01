<!DOCTYPE html>
<html lang="zxx" class="js">

    <head>
        @include('admin.layout.head')
    </head>
    <body class="nk-body bg-lighter npc-general has-sidebar ">
        @include('admin.layout.sidebar')
        <div class="nk-wrap ">
            @include('admin.layout.header')
            @yield('content')
            @include('admin.layout.footer')
        </div>
    </body>

    <script src="{{asset('assets/js/bundle.js?ver=2.5.0')}}"></script>
    <script src="{{asset('assets/js/scripts.js?ver=2.5.0')}}"></script>
    <script src="{{asset('assets/js/apps/messages.js?ver=2.5.0')}}"></script>
    @yield('link-js-cuoitrang')
</html>