<!DOCTYPE html>
<html >
<head>
    <!-- Site made with Mobirise Website Builder v4.8.8, https://mobirise.com -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="generator" content="Mobirise v4.8.8, mobirise.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}" type="image/x-icon">
    <meta name="description" content="Ruang Organisasi">
    <title>@yield('title')</title>
    
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
        
    @yield('js')
</body>
</html>