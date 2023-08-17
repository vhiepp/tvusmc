<!DOCTYPE html>
<html lang="en">
<head>

    @include('client.layouts.head')

    @yield('head')

    <script src="/assets/client/js/core/jquery.min.js" type="text/javascript"></script>
</head>
<style>
    * {
        scroll-behavior: smooth;
    }
    #navbar-main {
        background: #fff !important;
    }

    #btn-back {
        transition: all .3s ease;
    }
    #btn-back.hide {
        bottom: -5rem;
    }
    #btn-back.show {
        bottom: 1rem;
    }
</style>
<body class="index-page">

    @include('client.layouts.navbar')

    <div class="wrapper">

        @yield('header')

        @yield('content')

    </div>

    @include('client.layouts.footer')

    @include('client.layouts.updateinfo')

    <button class="btn btn-primary btn-icon-only back-to-top position-fixed right-1 hide" type="button" id="btn-back" name="button">
        <i class="ni ni-bold-up"></i>
    </button>

    @include('client.layouts.js')

    @yield('script')

</body>
</html>
