<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('admin.layouts.head')

    <title>{{ $title }} | TVU Social Media Club</title>

</head>
<body class="g-sidenav-show  bg-gray-100">

    @include('admin.layouts.navbar')
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('admin.layouts.header')
            
        @yield('content')

        @include('admin.layouts.footer')

    </main>

    @include('admin.layouts.js')

</body>
</html>