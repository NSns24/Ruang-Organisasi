<!DOCTYPE html>
<html >
<head>
    <!-- Site made with Mobirise Website Builder v4.8.8, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.8.8, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/image/icon/logo.png') }}" type="image/x-icon">
    <meta name="description" content="Ruang Organisasi">
    <title>@yield('title')</title>
    
    <link rel="stylesheet" href="{{ asset('assets/page/web/assets/mobirise-icons/mobirise-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/tether/tether.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/page/mobirise/css/mbr-additional.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('css')
</head>
<body>
    @yield('main')

    <section once="" class="cid-rcxEgBOzhw" id="footer6-1p">
        <div class="container">
            <div class="media-container-row align-center mbr-white">
                <div class="col-12">
                    <p class="mbr-text mb-0 mbr-fonts-style display-7">
                        © Copyright 2018 NS - Design by Mobirise
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    {{-- <script src="{{ asset('assets/page/web/assets/jquery/jquery.min.js') }}"></script> --}}
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/page/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/page/tether/tether.min.js') }}"></script>
    <script src="{{ asset('assets/page/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.32.4/dist/sweetalert2.all.min.js"></script>

    @yield('js')
</body>
</html>