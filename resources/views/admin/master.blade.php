<!DOCTYPE html>
<html lang="en" data-ds-theme="dark">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('admin.layouts.head')

    @yield('head')

    <title>{{ $title }} | TVU Social Media Club</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>
<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
            <div class="loader">
                <div class="cube">
                    <div class="sides">
                        <div class="top"></div>
                        <div class="right"></div>
                        <div class="bottom"></div>
                        <div class="left"></div>
                        <div class="front"></div>
                        <div class="back"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- loader END -->
    
    <div class="wrapper">
        @include('admin.layouts.sidebar')

        @include('admin.layouts.navbar')
        <!-- Page Content  -->
        <div id="content-page" class="content-page">

            <div class="container-fluid">
                @yield('content')
            </div>

        </div>


    </div>

    @include('admin.layouts.footer')
    
    @include('admin.alerts.notifications')

    @include('admin.layouts.js')

    @yield('script')

</body>
</html>