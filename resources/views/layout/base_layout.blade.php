<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>@yield('title') - {{lang('app')}} {{lang('app_l')}} {{lang('pemkab')}}</title> --}}
    <title>@yield('title') - {{lang('app')}} {{lang('app_l')}}</title>
    <link rel="icon" href="{{asset('assets/images/logo/fav-icon.png')}}" />

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/themify.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/animate.css') }}">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/custom.css') }}">

    <!-- latest jquery-->
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body onload="startTime()">
    <!-- loader starts-->
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div>
        <svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>

    <main>
        @yield('base')
    </main>

    <!-- feather icon js-->
    <script src="{{ asset('/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('/assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('/assets/js/config.js') }}"></script>

    {{-- Js Tambahan --}}
    @stack('jsTambahan')

    <script src="{{ asset('/assets/js/select2/select2.min.js') }}"></script>
    <script src="{{ asset('/assets/js/select2/select2.init.js') }}"></script>

    <!-- Plugins JS start-->
    <script src="{{ asset('/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('/assets/js/sidebar-pin.js') }}"></script>
    <script src="{{-- asset('/assets/js/clock.js') --}}"></script>
    <script src="{{ asset('/assets/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('/assets/js/header-slick.js') }}"></script>
    <script src="{{ asset('/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{-- asset('/assets/js/dashboard/default.js') --}}"></script>
    <script src="{{ asset('/assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('/assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('/assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('/assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('/assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('/assets/js/height-equal.js') }}"></script>
    <script src="{{ asset('/assets/js/animation/wow/wow.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('/assets/js/script.js') }}"></script>
    <script>
        const pesanGagal = "{{session()->get('Gagal')}}"
        const pesanBerhasil = "{{session()->get('Berhasil')}}"
        const peringatan = (icon, pesan) => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: icon,
                title: `<p style="margin: auto">${pesan}</p>`,
            });
        }

        if ("{{session()->has('Gagal')}}" != "") {
            peringatan('error', pesanGagal)
        }

        if ("{{session()->has('Berhasil')}}" != "") {
            peringatan('success', pesanBerhasil)
        }
    </script>

    <script>
        //new WOW().init();
    </script>
    {{-- <script src="{{ asset('/assets/js/theme-customizer/customizer.js') }}"></script> --}}
</body>

</html>