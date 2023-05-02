<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('client.layouts.head')

    @yield('head')

    <script src="/assets/client/js/core/jquery.min.js" type="text/javascript"></script>
</head>
<body class="index-page">
    
    @include('client.layouts.loader')
    
    @include('client.layouts.navbar')

    <div class="wrapper">
        
        @yield('header')

        @yield('content')

    </div>

    @include('client.layouts.footer')

    @include('client.layouts.updateinfo')

    @include('client.layouts.js')

    @yield('script')

</body>
</html>