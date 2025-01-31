<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{lang('app')}} {{lang('app_l')}} {{lang('pemkab')}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('/assets_front/images/fav-icon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('/assets_front/images/fav-icon.png') }}" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&amp;display=swap" rel="stylesheet">
    <!-- Swiper css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets_front/css/vendors/swiper/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets_front/css/vendors/swiper/swiper-bundle.min.css') }}">

    <!-- Font awesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets_front/css/vendors/fontawesome/all.css') }}">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets_front/css/style.css') }}">
    <!--
        Heri Mardiansah
        herimardiansah@gmail.com
        0857-2956-7887
        anauri.id
    -->
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader-index"> <span></span></div><svg>
            <defs></defs>
            <filter id="goo">
                <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
                <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo">
                </fecolormatrix>
            </filter>
        </svg>
    </div>
    <div class="tap-top"><i class="fa-solid fa-angles-up"></i></div>
    <main>
        <!-- Header start -->
        <header class="header-absolute">
            <nav class="navbar navbar-expand-lg bg-light">
                <div class="custom-container container">
                    <a class="navbar-brand m-0" href="{{route('front')}}">
                        <img src="{{ asset('/assets_front/images/logo/logo.png') }}" alt="logo">
                    </a>
                    {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button> --}}

                    {{-- <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav navigation">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('front')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tentang">Tentang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#layanan">Layanan</a>
                            </li>
                        </ul>
                    </div> --}}
                    <a href="{{route('auth')}}" class="btn btn-primary rounded-pill">Sign In <i class="fa-solid fa-right-to-bracket"></i></a>
                </div>
            </nav>
        </header>

        @yield('front_content')   

        <!-- Footer section start -->
        <footer class="footer-style-1">
            <div class="main-footer">
                <div class="container">
                    <div class="row gx-xl-5 gy-md-5 gy-4 gx-4">
                        <div class="col-xl-5">
                            <div class="footer-contact">

                                {{-- <img src="{{ asset('/assets_front/images/logo/logo-wilayah-small.png') }}" alt="logo"> --}}
                                <img src="{{ asset('/assets_front/images/logo/logo_dark.png') }}" alt="logo" width="150px">

                                <p>
                                    <strong>Sistem Keuangan</strong>
                                    <br />
                                    RT.09 / RW.20
                                    {{-- <br />
                                    Kementerian Pekerjaan Umum --}}
                                </p>
                                {{-- <ul>
                                    <li>
                                        <a href="https://www.facebook.com/"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/"><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://www.youtube.com/"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                    <li>
                                        <a href="https://in.pinterest.com/"><i class="fa-brands fa-pinterest"></i></a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                        {{-- <div class="col-xl-2 col-md-4 col-6">
                            <div class="footer-content">
                                <h3>Quick Link</h3>
                                <ul class="footer-links">
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Home </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>About Us</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Features</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Blog Page</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Login</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        {{-- <div class="col-xl-2 col-md-4 col-6">
                            <div class="footer-content">
                                <h3>Community</h3>
                                <ul class="footer-links">
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Career</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Leadership</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Strategy</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>Services</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa-solid fa-chevron-right"></i>
                                            <span>History</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        <div class="col-xl-7 col-md-7">
                            <div class="footer-content">
                                <h3>{{lang('pemkab')}}</h3>
                                <ul class="footer-location">
                                    <li>
                                        <div class="d-flex">
                                            <div class="footer-icon">
                                                <svg>
                                                    <use href="{{ asset('/assets_front/svg/icon_sprite.svg#map-pin') }}"></use>
                                                </svg>
                                            </div>
                                            <div>
                                                <h6>Alamat :</h6>
                                                <p>{{lang('alamat')}}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="footer-icon">
                                                <svg>
                                                    <use href="{{ asset('/assets_front/svg/icon_sprite.svg#inbox') }}"></use>
                                                </svg>
                                            </div>
                                            <div>
                                                <h6>Telepon :</h6>
                                                <p>{{lang('telepon')}}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="sub-footer">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <p>{{lang('app')}} © Copyright 2025 {{lang('skpd')}}</p>
                        </div>
                        <div class="col-md-6">
                            {{-- <ul class="footer-links sub-footer-links">
                                <li>
                                    <a href="#">Terms</a>
                                </li>
                                <li>
                                    <a href="#">Privacy</a>
                                </li>
                                <li>
                                    <a href="#">Support</a>
                                </li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Footer section end -->

    </main>

    <!-- bootstrap js -->
    <script src="{{ asset('/assets_front/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets_front/js/vendors/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

    <!-- swiper js -->
    <script src="{{ asset('/assets_front/js/vendors/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('/assets_front/js/custom-swiper.js') }}"></script>

    <!-- font awesome js -->
    <script src="{{ asset('/assets_front/js/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{ asset('/assets_front/js/jquery.marquee.min.js') }}"></script>


    <script src="{{ asset('/assets_front/js/script.js') }}"></script>
<script type="text/javascript">
$(function(){
$('.marq').marquee({
	speed: 45,
	gap: 900,
	delayBeforeStart: 0,
	direction: 'left',
	duplicated: true,
	pauseOnHover: true
});
});
</script>
@stack('jsTambahan')
</body>

</html>