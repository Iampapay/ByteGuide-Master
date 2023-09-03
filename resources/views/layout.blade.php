<!DOCTYPE html>
<html>

@include('includes.header')

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('includes.navigation')
        @include('includes.sidenav')
        @yield('content')
        @include('includes.footer')
        <div class="control-sidebar-bg"></div>
    </div>
    @include('includes.footer-js')
    </div>
</body>

</html>
