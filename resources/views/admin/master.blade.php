<!DOCTYPE html>
<html lang="en" data-ds-theme="dark">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/admin/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/assets/admin/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('admin.layouts.head')

    <title>{{ $title }} | TVU Social Media Club</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>
<body class="g-sidenav-show  bg-gray-200 ">
    <script>
        if (localStorage.getItem('theme') == 'dark') {
            document.body.classList.add('dark-version');
        }
    </script>
    @include('admin.layouts.navbar')
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('admin.layouts.header')
            
        @yield('content')

        @include('admin.layouts.footer')

        @include('admin.layouts.page_config')
    </main>

    @include('admin.alerts.notifications')
    
    @include('admin.layouts.js')

    @yield('script')

</body>
</html>