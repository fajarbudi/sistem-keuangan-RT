@extends('layout/front_layout')

@section('title')
Login
@endsection

@section('front_content')
        

        <!-- Home section start -->
        <section class="home-style-1 home-style-2" style="background-image: url({{ asset('/assets_front/images/front/bg-front-top.jpg') }}); background-position: bottom; background-repeat: no-repeat;">
            <div class="custom-container container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="home-content">
                            <h1>Aplikasi <span>YAKEPO</span></h1>
                            <h3>(<em>Layanan Kepegawaian Serayu Opak</em>)</h3>
                            <p>aplikasi yang dirancang untuk meningkatkan transparansi proses urusan kepegawaian yang dikelola oleh tim kepegawaian BBWS Serayu Opak.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 d-lg-block d-none">
                        <div class="home-image text-end d-md-block d-none">
                            <img class="rounded  img-fluid" src="{{ asset('/assets_front/images/front/front-top-1.jpg') }}" alt="front dashboards">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Home section end -->

        <!-- Service section start -->
        {{-- <section class="service-style-1" id="service">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-style-1 text-center">
                            <h5>Fungsi dan Layanan</h5>
                            <h2>Transparansi Proses Urusan Kepegawaian</h2>
                            <p>Melalui aplikasi ini para pegawai dapat memantau surat/usulan/proses kepegawaian miliknya. Para pegawai bisa memantau sampai di mana Usulan Kenaikan Pangkat, Pensiun, Kenaikan Gaji Berkala, Cuti, Pencantuman Gelar, Usulan Tunjangan dan Penyesuaian Gaji, Mutasi/Alih Tugas, Pengajuan Izin / Tugas Belajar, Usulan Diklat dan Pengembangan Kompetensi miliknya. Selain itu ada menu tambahan untuk melaporkan pelanggaran disiplin yang terjadi dan logbook yang mencatat kegiatan pegawai sehari-hari.</p>
                        </div>
                    </div>
                </div>
                
            </div>
        </section> --}}
        <!-- Service section end -->

        <!-- About section start -->
        <section class="about-style-1" id="about-us">
            <div class="custom-container container">
                <div class="row gy-4">
                    <div class="col-sm-12">
                        <div class="title-style-1 text-center">
                            <h5>Tentang Layanan Kepegawaian Serayu Opak</h5>
                            <h2>Kanal Komunikasi Layanan Kepegawaian</h2>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-images-wrapper">
                            <img class="img-fluid about-image" src="{{ asset('/assets_front/images/front/yakepo-front-2.png') }}" alt="overview chart">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <div class="title-style-1">
                                <h5>Layanan Kepegawaian yang Efektif dan Efisien</h5>
                            </div>
                            <p>Dalam rangka mewujudkan pembangunan Zona Integritas dalam aspek manajemen SDM dan penataan manajemen layanan kepegawaian agar lebih transparan, efektif dan efisien. Melalui aplikasi ini para pegawai dapat memantau surat/usulan/proses kepegawaian. Para pegawai bisa memantau sampai di mana Usulan Kenaikan Pangkat, Pensiun, Kenaikan Gaji Berkala, Cuti, Pencantuman Gelar, Usulan Tunjangan dan Penyesuaian Gaji, Mutasi/Alih Tugas, Pengajuan Izin / Tugas Belajar, Usulan Diklat dan Pengembangan Kompetensi miliknya. Selain itu ada menu tambahan untuk melaporkan pelanggaran disiplin yang terjadi dan logbook yang mencatat kegiatan pegawai sehari-hari.</p>
                            <ul>
                                <li>
                                    <div class="about-icon bg-light-primary">
                                        <svg>
                                            <use href="{{ asset('/assets_front/svg/icon_sprite.svg#calendar') }}"></use>
                                        </svg>
                                    </div>
                                    <p>Sebagai Media Informasi</p>
                                </li>
                                <li>
                                    <div class="about-icon bg-light-primary">
                                        <svg>
                                            <use href="{{ asset('/assets_front/svg/icon_sprite.svg#interface') }}"></use>
                                        </svg>
                                    </div>
                                    <p>Pengalaman Pemakaian yang Baik</p>
                                </li>
                                <li>
                                    <div class="about-icon bg-light-primary">
                                        <svg>
                                            <use href="{{ asset('/assets_front/svg/icon_sprite.svg#lock') }}"></use>
                                        </svg>
                                    </div>
                                    <p>Privasi dan Keamanan Data</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section end -->


        <!-- Feature section start -->
        <section class="feature-style-1" id="features">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-style-1 text-center">
                            <h5>Fungsi dan Layanan</h5>
                            <h2>Transparansi Proses Urusan Kepegawaian</h2>
                            <p>Untuk mengelola informasi terkait proses layanan kepegawaian dan untuk meningkatkan transparansi proses pelayanan kepegawaian bagi seluruh pegawai BBWS Serayu Opak.</p>
                        </div>
                    </div>
                </div>
                <div class="row feature-main-wrapper row-cols-lg-5 row-cols-sm-3 row-cols-1 gy-4">
                    <div class="col">
                        <div class="feature-wrapper">
                            <div class="feature-outline-box">
                                <div class="feature-box">
                                    <div class="feature-icon bg-light-info">
                                        <img src="{{ asset('/assets_front/images/sass/feature-icon/3.webp') }}" alt="icon">
                                    </div>
                                    <h3>Autentikasi & Privasi</h3>
                                </div>
                            </div>
                            <img class="outline-box" src="{{ asset('/assets_front/images/sass/shape/1.webp') }}" alt="shape arrow">
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-wrapper">
                            <div class="feature-outline-box">
                                <div class="feature-box">
                                    <div class="feature-icon bg-light-success">
                                        <img src="{{ asset('/assets_front/images/sass/feature-icon/1.webp') }}" alt="icon">
                                    </div>
                                    <h3>Data Kepegawaian</h3>
                                </div>
                            </div>
                            <img class="outline-box" src="{{ asset('/assets_front/images/sass/shape/3.webp') }}" alt="shape arrow">
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-wrapper">
                            <div class="feature-outline-box">
                                <div class="feature-box">
                                    <div class="feature-icon bg-light-warning">
                                        <img src="{{ asset('/assets_front/images/sass/feature-icon/2.webp') }}" alt="icon">
                                    </div>
                                    <h3>Informasi Data</h3>
                                </div>
                            </div>
                            <img class="outline-box" src="{{ asset('/assets_front/images/sass/shape/2.webp') }}" alt="shape arrow">
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-wrapper">
                            <div class="feature-outline-box">
                                <div class="feature-box">
                                    <div class="feature-icon bg-light-danger">
                                        <img src="{{ asset('/assets_front/images/sass/feature-icon/4.webp') }}" alt="icon">
                                    </div>
                                    <h3>Proses Pengajuan</h3>
                                </div>
                            </div>
                            <img class="outline-box" src="{{ asset('/assets_front/images/sass/shape/4.webp') }}" alt="shape arrow">
                        </div>
                    </div>
                    <div class="col">
                        <div class="feature-wrapper">
                            <div class="feature-outline-box">
                                <div class="feature-box">
                                    <div class="feature-icon bg-light-primary">
                                        <img src="{{ asset('/assets_front/images/sass/feature-icon/5.webp') }}" alt="icon">
                                    </div>
                                    <h3>Analisa & Laporan</h3>
                                </div>
                            </div>
                            <img class="outline-box" src="{{ asset('/assets_front/images/sass/shape/5.webp') }}" alt="shape arrow">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Feature section end -->

        <!-- Review section start -->
        <section class="brand-style-1 section-b-space" id="" style="background-color: rgba(var(--even-bg),1);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="title-style-1 text-center">
                            <h5>Pelayanan Kepegawaian</h5>
                            <h2>Layanan Keterbukaan Informasi</h2>
                            <p>Penataan layanan kepegawaian yang efektif dan efisien, melalui aplikasi ini para pegawai dapat memantau surat/usulan/proses kepegawaian</p>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <div class="brand-slider-wrapper">
                            <div class="swiper brand-slider-1">
                                <div class="swiper-wrapper text-center">
                                    @php $da = ['Kenaikan Gaji Berkala', 'Kenaikan Pangkat', 'Pensiun', 'Cuti', 'Logbook', 'Pencantuman Gelar', 'Usulan Tunjangan', 'Penyesuaian Gaji', 'Mutasi/Alih Tugas', 'Pengajuan Izin', 'Tugas Belajar', 'Usulan Diklat', 'Pengembangan Kompetensi']; @endphp
                                    @foreach ($da as $va)
                                    <div class="swiper-slide">
                                        <div class="brand-box">
                                            <h6 style="color: rgba(48, 70, 167, 0.8)"><strong>{{$va}}</strong></h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Review section end -->

@endsection

@push('jsTambahan')
<script>
    $('.show-hide').on('click', () => {
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text')
        } else {
            $('#password').attr('type', 'password')
        }
    })
</script>
@endpush