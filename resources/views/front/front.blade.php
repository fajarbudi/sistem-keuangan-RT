@extends('layout/front_layout')

@section('title')
Login
@endsection

@section('front_content')
        

        <!-- Home section start -->
        {{-- <section class="home-style-1 home-style-2" style="background-image: url({{ asset('/assets_front/images/front/bg-front-top.jpg') }}); background-position: bottom; background-repeat: no-repeat;">
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
        </section> --}}
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
        <section class="about-style-1 m-t-40" id="tentang" style="padding-top: 8.9rem;background-image: url({{ asset('/assets_front/images/front/bg-front-top.svg') }}); background-position: top; background-repeat: no-repeat; background-size: 100%, 100%;">
            <div class="custom-cont-ainer conta-iner container-fluid">
                <div class="row gy-4">
                    <div class="col-sm-12">
                        <div class="title-style-1 text-center">
                            <h5 style="color: #d770e9">Tentang Layanan</h5>
                            <h3>Sistem Keuangan RT.09 / RW.20</h3>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="about-images-wrapper gFront">
                            <img class="rounded img-fluid about-image" src="{{ asset('/assets_front/images/front/front-top-1.jpg') }}" alt="" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);text-align: center;">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-content">
                            <div class="title-style-1">
                                <h5  style="color: #d770e9">Sistem Keuangan yang Efektif dan Efisien</h5>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-4" style="margin-bottom: 15px; min-width: 160px;">
                                    <div class="feature-wrapper" style="padding: 20px 0;border: 2px solid #d359e9;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);backg-round: url({{ asset('/assets_front/images/sass/shape/5.webp') }}) no-repeat bottom center;">
                                        <div class="feature-outline-box">
                                            <div class="feature-box text-center" style="cursor: pointer;" onclick="showTentang();">
                                                <i class="fa-4x fa-solid fa-feather" style="color: #685cec;"></i>
                                                <h4 style="color: #685cec;margin-top: 15px;">Tentang</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4" style="margin-bottom: 15px; min-width: 160px;">
                                    <div class="feature-wrapper" style="padding: 20px 0;border: 2px solid #d359e9;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);backg-round: url({{ asset('/assets_front/images/sass/shape/5.webp') }}) no-repeat bottom center;">
                                        <div class="feature-outline-box">
                                            <div class="feature-box text-center" style="cursor: pointer;" onclick="showPengumuman();">
                                                <i class="fa-4x fa-solid fa-list" style="color:#685cec;"></i>
                                                <h4 style="color:#685cec;margin-top: 15px;">Pengumuman</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-6 col-md-4" style="margin-bottom: 15px;">
                                    <div class="feature-wrapper" style="padding: 20px 0;border: 2px solid #d359e9;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);backg-round: url({{ asset('/assets_front/images/sass/shape/5.webp') }}) no-repeat bottom center;">
                                        <div class="feature-outline-box">
                                            <div class="feature-box text-center" style="cursor: pointer;" onclick="showSop();">
                                                <i class="fa-4x fa-solid fa-newspaper" style="color:#685cec;"></i>
                                                <h4 style="color:#685cec;margin-top: 15px;">SOP</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-6 col-md-4" style="margin-bottom: 15px; min-width: 160px;">
                                    <div class="feature-wrapper" style="padding: 20px 0;border: 2px solid #d359e9;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);back-ground: url({{ asset('/assets_front/images/sass/shape/5.webp') }}) no-repeat bottom center;">
                                        <div class="feature-outline-box">
                                            <div class="feature-box text-center" style="cursor: pointer;" onclick="showPeraturan();">
                                                <i class="fa-4x fa-solid fa-book" style="color:#685cec;"></i>
                                                <h4 style="color:#685cec;margin-top: 15px;">Peraturan</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-6 col-md-4" style="margin-bottom: 15px;">
                                    <div class="feature-wrapper" style="padding: 20px 0;border: 2px solid #d359e9;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);back-ground: url({{ asset('/assets_front/images/sass/shape/5.webp') }}) no-repeat bottom center;">
                                        <div class="feature-outline-box">
                                            <div class="feature-box text-center" style="cursor: pointer;" onclick="goLogin();">
                                                <i class="fa-4x fa-solid fa-pen-to-square" style="color:#685cec;"></i>
                                                <h4 style="color:#685cec;margin-top: 15px;">Pengaduan Disiplin</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-6 col-md-4" style="margin-bottom: 15px; min-width: 160px;">
                                    <div class="feature-wrapper" style="padding: 20px 0;border: 2px solid #d359e9;border-radius: 25px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.15);back-ground: url({{ asset('/assets_front/images/sass/shape/5.webp') }}) no-repeat bottom center;">
                                        <div class="feature-outline-box">
                                            <div class="feature-box text-center" style="cursor: pointer;" onclick="goLogin();">
                                                <i class="fa-4x fa-solid fa-right-to-bracket" style="color:#685cec;"></i>
                                                <h4 style="color:#685cec;margin-top: 15px;">Sign In</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section end -->
        @if($pe_text)
            <section class="service-style-1" id="running">
                <div class="custom-container container cont-ainer-fluid">
                <div class="marq" style="font-size: 1.3rem">
                    @foreach($pe_text as $p)
                            <strong>{{$p->pengumuman_judul}}</strong> &ensp; {{$p->pengumuman_isi}} &emsp; &nbsp; &emsp; &nbsp; &emsp; &nbsp; &emsp; &nbsp; &emsp;
                    @endforeach
                </div>
                </div>
            </section>
        @endif
            <section>
            </section>



        <div class="modal fade" id="showTentang" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i>{{$tentang->tentang_judul ?? ''}}</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="overflow-y: auto; max-height: 700px">
                        <p>{{$tentang->tentang_isi ?? ''}}</p>                                                
                    </div>
                </div>
            </div>
        </div>

    @if($g_popup)
        <div class="modal fade" id="showAuto" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    {{-- <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> Informasi Kepegawaian Serayu Opak</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div> --}}
                    <div class="mo-dal-body" style="overflow-y: auto; max-height: 700px">
                        <div class="list-group">
                            @foreach($g_popup as $val)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink" style="cursor: pointer" onclick="show('{{url('storage/'.$val['gambar'])}}')">
                                        <img src="{{asset('storage/'.$val['gambar'])}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="mb-1" style="font-size: 1.3rem;">{{strtoupper($val['judul'])}}</h3>
                                        <p>{{$val['isi']}}</p>
                                        @if($val['pdf'])
                                            <button onclick="show('{{url('storage/'.$val['pdf'])}}')" class="btn btn-primary rounded-pill">
                                                <i class="fa-solid fa-file-pdf"></i> Download
                                            </button>
                                        @endif
                                    </div>
                                </div>                            
                            </div>                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
        <div class="modal fade" id="showPengumuman" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> Pengumuman</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="mod-al-body" style="overflow-y: auto; max-height: 700px">
                        <div class="list-group">
                            @foreach($pe as $val)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink" style="cursor: pointer" onclick="show('{{url('storage/'.$val->pengumuman_gambar)}}')">
                                        <img src="{{asset('storage/'.$val->pengumuman_gambar)}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="mb-1" style="font-size: 1.3rem;">{{strtoupper($val->pengumuman_judul)}}</h3>
                                        <p>{{$val->pengumuman_isi}}</p>
                                        @if($val->pengumuman_pdf)
                                            <button onclick="show('{{url('storage/'.$val->pengumuman_pdf)}}')" class="btn btn-primary rounded-pill">
                                                <i class="fa-solid fa-file-pdf"></i> Download
                                            </button>
                                        @endif
                                    </div>
                                </div>                            
                            </div>                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="showSOP" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> Standar Operasional Prosedur (SOP)</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="mod-al-body" style="overflow-y: auto; max-height: 700px">
                        <div class="list-group">
                            @foreach($g_sop as $val)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink" style="cursor: pointer" onclick="show('{{url('storage/'.$val->sop_gambar)}}')">
                                        <img src="{{asset('storage/'.$val->sop_gambar)}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="mb-1" style="font-size: 1.3rem;">{{strtoupper($val->sop_judul)}}</h3>
                                        <p>{{$val->sop_isi}}</p>
                                        @if($val->sop_pdf)
                                            <button onclick="show('{{url('storage/'.$val->sop_pdf)}}')" class="btn btn-primary rounded-pill">
                                                <i class="fa-solid fa-file-pdf"></i> Download
                                            </button>
                                        @endif
                                    </div>
                                </div>                            
                            </div>                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="showPeraturan" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> Peraturan Tentang Kepegawaian</h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="mod-al-body" style="overflow-y: auto; max-height: 700px">
                        <div class="list-group">
                            @foreach($g_per as $val)
                            <div class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink" style="cursor: pointer" onclick="show('{{url('storage/'.$val->peraturan_gambar)}}')">
                                        <img src="{{asset('storage/'.$val->peraturan_gambar)}}" alt="" class="img-thumbnail">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h3 class="mb-1" style="font-size: 1.3rem;">{{strtoupper($val->peraturan_judul)}}</h3>
                                        <p>{{$val->peraturan_isi}}</p>
                                        @if($val->peraturan_pdf)
                                            <button onclick="show('{{url('storage/'.$val->peraturan_pdf)}}')" class="btn btn-primary rounded-pill">
                                                <i class="fa-solid fa-file-pdf"></i> Download
                                            </button>
                                        @endif
                                    </div>
                                </div>                            
                            </div>                            
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
<div class="modal fade" id="fileShowModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-toggle-wrapper">
                    <iframe id="fileShow" frameborder="0" height="800px" width="100%" ></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('jsTambahan')
<script>
    @if($g_popup)
    $(function(){
        setTimeout(() => {
            $('#showAuto').modal('show');  
        }, 1100);
    });
    @endif
    const goLogin = () =>{
        location.href = "{{url('auth')}}";
    }
    
    const showTentang = () =>{
        $('#showTentang').modal('show')
    }
    
    const showPengumuman = () =>{
        $('#showPengumuman').modal('show')
    }

    const showSop = () =>{
        $('#showSOP').modal('show')
    }

    const showPeraturan = () =>{
        $('#showPeraturan').modal('show')
    }
    
    const show = (url) =>{
        $('#fileShowModal').modal('show')
        $('#fileShow').attr('src', `${url}`)
    }

    $('.show-hide').on('click', () => {
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text')
        } else {
            $('#password').attr('type', 'password')
        }
    })

    const lebar = window.innerWidth;
    if(lebar <= 990){
        $('.gFront').attr('style', 'display: flex; justify-content: center !important')
    }
</script>
@endpush