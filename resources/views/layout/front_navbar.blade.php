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
                <div class="notification-slider">
                    <div class="d-flex h-100"> <img src="{{ asset('/assets/images/giftools.gif') }}" alt="gif">
                        <h6 class="mb-0 f-w-400"><span class="font-primary">Don't Miss Out! </span><span class="f-light">Out new update has been release.</span></h6><i class="icon-arrow-top-right f-light"></i>
                    </div>
                    <div class="d-flex h-100"><img src="{{ asset('/assets/images/giftools.gif') }}" alt="gif">
                        <h6 class="mb-0 f-w-400"><span class="f-light">Something you love is now on sale! </span></h6><a class="ms-1" href="https://1.envato.market/3GVzd" target="_blank">Buy now !</a>
                    </div>
                </div>
            </div>
            <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                <ul class="nav-menus">
                    <li class="language-nav">
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
                    </li>
                    <li> <span class="header-search">
                            <svg>
                                <use href="../assets/svg/icon-sprite.svg#search"></use>
                            </svg></span></li>
                    <li class="profile-nav onhover-dropdown pe-0 py-0">
                        <div class="media profile-media"><img class="b-r-10" src="{{ asset('/assets/images/dashboard/profile.png') }}" alt="">
                            <div class="media-body"><span>xxx</span>
                                <p class="mb-0">Admin <i class="middle fa fa-angle-down"></i></p>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                            <li><a href="#"><i data-feather="user"></i><span>Account </span></a></li>
                            <li><a href="#"><i data-feather="mail"></i><span>Inbox</span></a></li>
                            <li><a href="#"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                            <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a></li>
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
                <div class="logo-wrapper"><a href="index.html"><img height="40" class="img-fl-uid for-light" src="{{asset('assets/images/logo/logo-2.png')}}" alt=""><img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt=""></a>
                    <div class="back-btn"><i class="fa fa-angle-left"></i></div>
                    <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
                    </div>
                </div>
                <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo-icon.png') }}" alt=""></a></div>
                <nav class="sidebar-main">
                    <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
                    <div id="sidebar-menu">
                        <ul class="sidebar-links" id="simple-bar">
                            <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ asset('/assets/images/logo/logo-icon.png') }}" alt=""></a>
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
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav {{($namaPage[0] == 'Dashboard') ? 'active' : ''}}" href="{{url('/')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                                    </svg><span>Dashboard</span></a>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Pegawai') ? 'active' : ''}}" href="{{url('/pegawai')}}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                </svg>
                                <svg class="fill-icon">
                                    <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                </svg><span>Pegawai</span></a>
                        </li>
                            {{-- @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'SPT') ? 'active' : ''}}" href="{{url('/spt')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                    </svg><span>SPT</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'ATK') ? 'active' : ''}}" href="{{url('/atk')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                    </svg><span>ATK</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Perjalanan') ? 'active' : ''}}" href="{{url('/perjalanan_dinas')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                    </svg><span>Perjalanan Dinas</span></a>
                            </li>
                            @endcan --}}
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title {{($namaPage[0] == 'Widget') ? 'active' : ''}}" href="#">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-widget') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-widget') }}"></use>
                                    </svg><span class="lan-6">Widgets</span></a>
                                <ul class="sidebar-submenu {{($namaPage[0] == 'Widget') ? 'd-block' : ''}}">
                                    <li><a href="general-widget.html" class="{{(isset($namaPage[1]) == 'General') ? 'active' : ''}}">General</a>
                                    </li>
                                    <li><a href="chart-widget.html">Chart</a></li>
                                </ul>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-layout') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-layout') }}"></use>
                                    </svg><span class="lan-7">Page layout</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="box-layout.html">Boxed</a></li>
                                    <li><a href="layout-rtl.html">RTL</a></li>
                                    <li><a href="layout-dark.html">Dark Layout</a></li>
                                    <li><a href="hide-on-scroll.html">Hide Nav Scroll</a></li>
                                    <li><a href="footer-light.html">Footer Light</a></li>
                                    <li><a href="footer-dark.html">Footer Dark</a></li>
                                    <li><a href="footer-fixed.html">Footer Fixed</a></li>
                                </ul>
                            </li>

                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Referensi</h6>
                                </div>
                            </li>
                            {{-- @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Data') ? 'active' : ''}}" href="{{url('/data')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-file') }}"></use>
                                    </svg><span>Data Referensi</span></a>
                            </li>
                            @endcan --}}
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Eselon') ? 'active' : ''}}" href="{{url('/referensi/eselon')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Eselon</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Jabatan') ? 'active' : ''}}" href="{{url('/referensi/jabatan')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Jabatan</span></a>
                            </li>
                            @endcan
                            @can('admin', App\Models\User::class)
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav  {{($namaPage[0] == 'Golongan') ? 'active' : ''}}" href="{{url('/referensi/golongan')}}">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-file') }}"></use>
                                    </svg>
                                    <span>Golongan</span></a>
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
                            <li class="sidebar-main-title">
                                <div>
                                    <h6>Miscellaneous</h6>
                                </div>
                            </li>
                            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="support-ticket.html">
                                    <svg class="stroke-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#stroke-support-tickets') }}"></use>
                                    </svg>
                                    <svg class="fill-icon">
                                        <use href="{{ asset('/assets/svg/icon-sprite.svg#fill-support-tickets') }}"></use>
                                    </svg><span>Support Ticket</span></a></li>
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