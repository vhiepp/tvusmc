<!DOCTYPE html>
<html lang="en">
<head>
    
    @include('client.layouts.head')


</head>
<body class="index-page">
    
    @include('client.layouts.navbar')

    <div class="wrapper">
        
        @yield('header')

        @yield('content')

    </div>

    @include('client.layouts.footer')

    @include('client.layouts.js')
</body>
</html>