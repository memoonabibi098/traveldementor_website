<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="icon" href="{{ asset('images/dashboard/dark-scroll-logo.webp') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/LineIcons.2.0.css') }}" />
    <link rel="stylesheet" href="{{ asset('font-awesome/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/nav-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard.css') }}">
    @stack('styles')
</head>

<body>
    <div class="wrapper">
        @include('dashboard.layouts.nav-bar')
        @include('dashboard.layouts.sidebar')
        <div class="main-panel">
            <div class="container">
                <div class="page-inner">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>

<!-- jQuery Sparkline -->
<script src="{{ asset('vendor/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

<!-- Chart Circle -->
<script src="{{ asset('vendor/chart-circle/circles.min.js') }}"></script>

<!-- Datatables -->
<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>


<!-- jQuery Vector Maps -->
<script src="{{ asset('vendor/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('vendor/jsvectormap/world.js') }}"></script>
<!-- Kaiadmin JS -->
<script src="{{ asset('vendor/kaiadmin.min.js') }}"></script>

<script src="{{ asset('js/dashboard/nav-bar.js') }}"></script>
<script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
@stack('scripts')

</html>