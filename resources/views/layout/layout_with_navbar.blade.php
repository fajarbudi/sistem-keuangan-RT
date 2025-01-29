@extends('layout/base_layout')

@php
$namaPage = explode(' ', $namaPage);
@endphp

@section('base')
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->

    <div class="page-header">
        <div class="header-wrapper row m-0">
            <form class="form-inline search-full col" action="#" method="get">
                <div class="form-group w-100">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                            <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form>
            <div class="header-logo-wrapper col-auto p-0">
                <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="../assets/images/logo/logo-2.png" alt=""></a></div>
                <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
            </div>
            <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
                {{-- <div class="notification-slider">
                    <div class="d-flex h-100"> <img src="{{ asset('/assets/images/giftools.gif') }}" alt="gif">
                        <h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light">Out new update has been release.</span></h6><i class="icon-arrow-top-right f-light"></i>
                    </div>
                    <div class="d-flex h-100"><img src="{{ asset('/assets/images/giftools.gif') }}" alt="gif">
                        <h6 class="mb-0 f-w-400"><span class="f-light">Something you love is now on sale! </span></h6><a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
                    </div>
                </div> --}}
            </div>
            <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                <ul class="nav-menus">
                    {{-- <li class="language-nav">
                        <div class="translate_wrapper">
                            <div class="current_lang">
                                <div class="lang"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">EN
                                    </span></div>
                            </div>
                            <div class="more_lang">
                                <div class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i><span class="lang-txt">English<span> (US)</span></span></div>
                                <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i><span class="lang-txt">Deutsch</span></div>
                                <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i><span class="lang-txt">Español</span></div>
                                <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i><span class="lang-txt">Français</span></div>
                                <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i><span class="lang-txt">Português<span> (BR)</span></span></div>
                                <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i><span class="lang-txt">简体中文</span></div>
                                <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i><span class="lang-txt">لعربية <span> (ae)</span></span></div>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li> <span class="header-search">
                            <svg>
                                <use href="../assets/svg/icon-sprite.svg#search"></use>
                            </svg></span></li> --}}
                    <li class="profile-nav onhover-dropdown pe-0 py-0">
                        <div class="media profile-media">
                            <div style="width: 40px; height: 40px; overflow: hidden;">
                                @php
                                    $userLogin = Auth::user()
                                @endphp
                                <img style="" src="@if (isset($userLogin->user_foto))
                                   {{ url('storage/'. $userLogin->user_foto)}}
                                @else
                                    {{asset('/assets/images/dashboard/profile.png')}}
                                @endif" alt="" width="40px">
                            </div>
                            <div class="media-body"><span>{{$userLogin->user_nama}}</span>
                                <p class="mb-0">{{$userLogin->user_role ?? 'Tidak Ada Jabatan'}} <i class="middle fa fa-angle-down"></i></p>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div" style="width: 200px">
                            <li><a href="{{url('/user/update')}}"><i data-feather="settings"></i><span>Update Profile</span></a></li>
                            <form action="{{ url('/logout') }}" method="POST" id="logout">
                                @csrf
                            </form>
                            <li onclick="$('#logout').submit()">
                                <i data-feather="log-in"> </i><span>Log Out</span>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Header Ends  -->

    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" sidebar-layout="stroke-svg">
            <div>
                <div class="logo-wrapper"><a href="{{url('dashboard')}}"><img height="40" class="img-fl-uid for-light" src="{{asset('assets/images/logo/logo-2.png')}}" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
                    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                    </div>
                </div>
                <div class="logo-icon-wrapper"><a href="{{url('dashboard')}}"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo-icon.png') }}" alt="" width="30px"></a></div>
                <nav class="sidebar-main">
                    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                    <div id="sidebar-menu">
                        <ul class="sidebar-links" id="simple-bar">
                            <li class="back-btn"><a href="{{url('dashboard')}}"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo-icon.png') }}" alt="" width="30px"></a>
                                <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                            </li>
                            <li class="pin-title sidebar-main-title">
                                <div>
                                    <h6>Pinned</h6>
                                </div>
                            </li>
                            <li class="sidebar-main-title">
                                <div>
                                    <h6 class="lan-1">General</h6>
                                </div>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav {{($namaPage[0] == 'Dashboard') ? 'active' : ''}}" href="{{url('dashboard')}}">
                                <div class="row">
                                    <i class="icon-home fs-5 col-2"></i>
                                    <span class="col-10">Dashboard</span>
                                </div>
                                </a>
                            </li>
                       
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Warga') ? 'active' : ''}}" href="{{url('/warga')}}">
                                <div class="row">
                                    <i class="icofont icofont-business-man fs-5 col-2"></i>
                                    <span class="col-10">Warga</span>
                                </div>
                            </a>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Pertemuan') ? 'active' : ''}}" href="{{route('pertemuan')}}">
                                <div class="row">
                                    <i class="icofont icofont-people fs-5 col-2"></i>
                                    <span class="col-10">Pertemuan</span>
                                </div>
                            </a>
                            </li>
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Iuran') ? 'active' : ''}}" href="{{route('iuran')}}">
                                <div class="row">
                                    <i class="icofont icofont-money-bag fs-5 col-2"></i>
                                    <span class="col-10">Iuran</span>
                                </div>
                            </a>
                            </li>
                            @endcan
                            @can('warga', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'IuranWargaView') ? 'active' : ''}}" href="{{route('iuran.warga_view')}}">
                                <div class="row">
                                    <i class="icofont icofont-money-bag fs-5 col-2"></i>
                                    <span class="col-10">Iuran</span>
                                </div>
                            </a>
                            </li>
                            @endcan
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'SaldoMasuk') ? 'active' : ''}}" href="{{route('saldo_masuk')}}">
                                <div class="row">
                                    <i class="icofont icofont-chart-histogram-alt fs-5 col-2"></i>
                                    <span class="col-10">Saldo Masuk</span>
                                </div>
                            </a>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'SaldoKeluar') ? 'active' : ''}}" href="{{route('saldo_keluar')}}">
                                <div class="row">
                                    <i class="icofont icofont-chart-bar-graph fs-5 col-2"></i>
                                    <span class="col-10">Saldo Keluar</span>
                                </div>
                            </a>
                            </li>
                    
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Rekapitulasi</h6>
                                </div>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'RekapSaldoMasuk') ? 'active' : ''}}" href="{{route('rekap_saldo_masuk')}}">
                                <div class="row">
                                    <i class="icofont icofont-chart-line-alt fs-5 col-2"></i>
                                    <span class="col-10">Saldo Masuk</span>
                                </div>
                            </a>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'RekapSaldoKeluar') ? 'active' : ''}}" href="{{route('rekap_saldo_keluar')}}">
                                <div class="row">
                                    <i class="icofont icofont-chart-arrows-axis fs-5 col-2"></i>
                                    <span class="col-10">Saldo Keluar</span>
                                </div>
                            </a>
                            </li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Publikasi</h6>
                                </div>
                            </li>

                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'SOP') ? 'active' : ''}}" href="{{route('sop')}}">
                                <div class="row">
                                    <i class="icofont icofont-presentation-alt fs-5 col-2"></i>
                                    <span class="col-10">SOP</span>
                                </div>
                            </a>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Peraturan') ? 'active' : ''}}" href="{{route('peraturan')}}">
                                <div class="row">
                                    <i class="icofont icofont-list fs-5 col-2"></i>
                                    <span class="col-10">Peraturan</span>
                                </div>
                            </a>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Pengumuman') ? 'active' : ''}}" href="{{route('pengumuman')}}">
                                <div class="row">
                                    <i class="fa fa-bullhorn fs-5 col-2"></i>
                                    <span class="col-10">Pengumuman</span>
                                </div>
                            </a>
                            </li>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Tentang') ? 'active' : ''}}" href="{{route('tentang')}}">
                                <div class="row">
                                    <i class="icofont icofont-read-book fs-5 col-2"></i>
                                    <span class="col-10">Tentang</span>
                                </div>
                            </a>
                            </li>

                            @can('admin', App\Models\User::class)
                                <li class="sidebar-main-title">
                                    <div>
                                        <h6>Referensi</h6>
                                    </div>
                                </li>
                          
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'JenisSaldoMasuk') ? 'active' : ''}}" href="{{route('jenis_saldo_masuk')}}">
                                  <div class="row">
                                    <i class="icon-stats-up fs-5 col-2"></i>
                                    <span class="col-10">Jenis Saldo Masuk</span>
                                  </div>
                                </a>
                            </li>
                        
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'JenisSaldoKeluar') ? 'active' : ''}}" href="{{route('jenis_saldo_keluar')}}">
                                  <div class="row">
                                    <i class="icon-stats-down fs-5 col-2"></i>
                                    <span class="col-10">Jenis Saldo Keluar</span>
                                  </div>
                                </a>
                            </li>
                          
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'JenisIuran') ? 'active' : ''}}" href="{{route('jenis_iuran')}}">
                                  <div class="row">
                                    <i class="icofont icofont-coins fs-5 col-2"></i>
                                    <span class="col-10">Jenis Iuran</span>
                                  </div>
                                </a>
                            </li>
                            @endcan
                            {{-- @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'JenisDokumen') ? 'active' : ''}}" href="{{url('/referensi/jenisDokumen')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Jenis Dokumen</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Provinsi') ? 'active' : ''}}" href="{{route('provinsi')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Provinsi</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Kabupaten') ? 'active' : ''}}" href="{{route('kabupaten')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Kabupaten</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Kecamatan') ? 'active' : ''}}" href="{{route('kecamatan')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Kecamatan</span></a>
                            </li>
                            @endcan --}}
                            {{-- <li class="sidebar-main-title">
                                <div>
                                    <h6>Miscellaneous</h6>
                                </div>
                            </li> --}}
                            {{-- <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="support-ticket.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-support-tickets') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-support-tickets') }}"></use>
                                    </svg><span>Support Ticket</span></a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
                </nav>
            </div>
        </div>
        <!-- Page Sidebar Ends-->

        {{-- Content --}}
        <div class="page-body">
            @yield('content')
        </div>

        <!-- footer start-->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 footer-copyright text-center">
                        <p class="mb-0">{{lang('app')}} {{date('Y')}} © {{lang('app_l')}} {{lang('pemkab')}} {{lang('powered')}} </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection


@push('jsTambahan')

@endpush