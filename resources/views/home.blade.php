@extends('layout/layout_with_navbar')

@section('title')
Home
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="col-6">
            <h4>Dashboard</h4>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col-xxl-5">
            <div class="row justify-content-center">
                <div class="card profile-box col-11 col-md-10">
                    <div class="card-body">
                        <div class="media media-wrapper justify-content-between">
                            <div class="media-body">
                                <div class="greeting-user">
                                    <h4 class="f-w-500 fs-3 mb-2">Selamat <span id="waktu"></span></h4>
                                    <div style="width: 170%" class="mb-5">
                                        <p>
                                            <span>Nama <span style="margin-left: 20px; margin-right: 10px">:</span> {{$userLogin->user_nama ?? ''}}</span>
                                            <br>
                                            <span>Email <span style="margin-left: 20px; margin-right: 10px">:</span> {{$userLogin->user_email ?? ''}}</span>
                                            <br>
                                            <span>Gender <span class="mx-2">:</span> {{jenis_kelamin()[$userLogin->user_jenis_kelamin ?? '']}}</span>
                                            <br>
                                            <span>Role <span style="margin-left: 28px; margin-right: 10px">:</span> {{$userLogin->user_role ?? ''}}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="clockbox">
                                    <div class="fs-4" style="min-width: 65px">
                                        <span id="jam"></span> : <span id="menit"></span>
                                    </div>
                                    {{-- <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                                        <g id="face">
                                            <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                                            <path class="hour-marks"
                                                d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6">
                                            </path>
                                            <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                                        </g>
                                        <g id="hour">
                                            <path class="hour-hand" d="M300.5 298V142"></path>
                                            <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                        </g>
                                        <g id="minute">
                                            <path class="minute-hand" d="M300.5 298V67"> </path>
                                            <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                                        </g>
                                        <g id="second">
                                            <path class="second-hand" d="M300.5 350V55"></path>
                                            <circle class="sizing-box" cx="300" cy="300" r="253.9"> </circle>
                                        </g>
                                    </svg> --}}
                                </div>
                                <div class="badge f-10 p-0" id="txt"></div>
                            </div>
                        </div>
                        <div style="padding-right: 20px" class="cartoon"><img class="img-fluid" src="../assets/images/dashboard/cartoon.svg"
                                alt="vector women with leptop"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-7">
            <div class="row justify-content-center" style="align-items: center">
                <div class="col-md-5" style="min-width: 380px"> 
                    <div class="card small-widget"> 
                      <div class="card-body warning">
                        <div class="row">
                            <div class="col-6">
                                <span class="f-light">Uang Masuk Terbaru</span>
                                <br>
                                <h4>Rp {{number_format($saldo_masuk_terakhir->saldo_nominal ?? 0, 0, ",", ".")}}</h4>
                            </div>
                            <div class="col-6">
                                <span class="f-light">Uang Keluar Terbaru</span>
                                <br>
                                <h4>Rp {{number_format($saldo_keluar_terakhir->saldo_nominal ?? 0, 0, ",", ".")}}</h4>
                            </div>
                           @if (Auth::user()->can('admin', App\Models\User::class) || Auth::user()->can('bendahara', App\Models\User::class))
                             <div class="col-6 mt-3">
                               <button class="btn btn-primary" onclick="input('{{route('saldo_masuk.add')}}', 'Saldo Masuk')"><i class="icon-pencil-alt me-1"></i>Input Data</button>
                            </div>
                            <div class="col-6 mt-3">
                               <button class="btn btn-danger" onclick="input('{{route('saldo_keluar.add')}}', 'Saldo Keluar')"><i class="icon-pencil-alt me-1"></i>Input Data</button>
                            </div>
                           @endif
                        </div>
                        <div class="bg-gradient"> 
                          {{-- <svg class="stroke-icon svg-fill">
                            <use href="../assets/svg/icon-sprite.svg#new-order"></use>
                          </svg> --}}
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-5" > 
                    <div class="card small-widget"> 
                      <div class="card-body primary"> <span class="f-light">Saldo Saat Ini</span>
                        <div class="d-flex align-items-end gap-1">
                          <h4>Rp {{number_format($saldo_terakhir->saldo_total ?? 0, 0, ",", ".")}}</h4>
                        </div>
                        <div class="bg-gradient"> 
                          {{-- <svg class="stroke-icon svg-fill">
                            <use href="../assets/svg/icon-sprite.svg#new-order"></use>
                          </svg> --}}
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-5"> 
                    <div class="card small-widget"> 
                      <div class="card-body success"> <span class="f-light">Total Pemasukan</span> <span class="f-light">---</span> <span class="f-light">{{$bulan}}</span> <span class="f-light">{{$tahun}}</span>
                        <div class="d-flex align-items-end gap-1">
                          <h4>Rp {{number_format($saldo_masuk ?? 0, 0, ",", ".")}}</h4>
                        </div>
                        <div class="bg-gradient"> 
                          {{-- <svg class="stroke-icon svg-fill">
                            <use href="../assets/svg/icon-sprite.svg#new-order"></use>
                          </svg> --}}
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-5"> 
                    <div class="card small-widget"> 
                      <div class="card-body secondary"> <span class="f-light">Total Pengeluaran</span> <span class="f-light">---</span> <span class="f-light">{{$bulan}}</span> <span class="f-light">{{$tahun}}</span>
                        <div class="d-flex align-items-end gap-1">
                          <h4>Rp {{number_format($saldo_keluar ?? 0, 0, ",", ".")}}</h4>
                        </div>
                        <div class="bg-gradient"> 
                          {{-- <svg class="stroke-icon svg-fill">
                            <use href="../assets/svg/icon-sprite.svg#new-order"></use>
                          </svg> --}}
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-12" style="height: 5vh"></div>

        <div style="min-width: 400px;" class="col-xxl-4 col-md-12 appointment-sec">
            <div class="appointment">
                <div class="card p-3 text-center">
                    <h3 id="none1" class="d-none">Tidak Ada Data....</h3>
                    <div id="chart1"></div>
                </div>
            </div>
            <div class="appointment">
              <div class="card p-3 text-center">
                  <h3 id="none2" class="d-none">Tidak Ada Data....</h3>
                  <div id="chart2"></div>
              </div>
          </div>
        </div>

        <div style="min-width: 400px" class="col-xxl-8 col-md-12 appointment-sec">
            <div class="appointment">
                <div class="card p-3">
                    <div id="perBulan" class="d-flex justify-content-center"></div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Modal Tambah dan Update --}}
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-toggle-wrapper text-start dark-sign-up">
              <form id="formData" class=" needs-validation" novalidate="" method="POST">
                  <div class="modal-header">
                      <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span id="judulModal">Tambah Data</span></h5>
                      <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      @csrf
                      <input type="hidden" id="saldo_nominal" name="saldo_nominal">
                      <div class="row g-3">
                          <input type="hidden" name="old_saldo" id="old_saldo">
                          <div class="col-md-12">
                              <label class="form-label" for="saldo_keterangan">Keterangan</label>
                              <input class="form-control" id="saldo_keterangan" type="text" placeholder="Masukkan keterangan saldo..." required="" name="saldo_keterangan">
                          </div>
                          <div class="col-md-12" id="saldo_masuk">
                              <label class="form-label" for="jenis_saldo_masuk">Jenis Saldo</label>
                              <select id="jenis_saldo_masuk" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                  <option value="">--Pilih--</option>
                                  @foreach ($jenis_saldo_masuk as $val)
                                    @if ($val->jenis_saldo_masuk_nama != 'Iuran')
                                    <option value="{{$val->jenis_saldo_masuk_id}}">{{$val->jenis_saldo_masuk_nama}}</option>
                                    @endif
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-12" id="saldo_keluar">
                              <label class="form-label" for="jenis_saldo_keluar">Jenis Saldo</label>
                              <select id="jenis_saldo_keluar" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                  <option value="">--Pilih--</option>
                                  @foreach ($jenis_saldo_keluar as $val)
                                  <option value="{{$val->jenis_saldo_keluar_id}}">{{$val->jenis_saldo_keluar_nama}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-md-12">
                              <label class="form-label" for="saldo_tgl">Tanggal</label>
                              <input class="form-control digits" id="saldo_tgl" type="date" data-date-format="YYYY-mm-dd" required="" name="saldo_tgl">
                              <div class="invalid-feedback">Isian tidak sesuai...</div>
                          </div>
                          <div class="col-md-12">
                              <label class="form-label" for="nominal">Nominal</label>
                              <input class="form-control" id="nominal" type="text" placeholder="Masukkan nominal saldo..." required="" name="">
                          </div>
                          <div class="col-12">
                              <div class=" row gap-2">
                                  @foreach ($ref_nominal as $vNom)
                                      <button style="min-width: 100px;" type="button" class="btn btn-sm blue-steel col" onclick="bantuanNominal({{$vNom->nominal_nominal}})">Rp {{number_format($vNom->nominal_nominal, 0, ",", ".")}}</button>
                                  @endforeach
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <div class="col">
                          <button class="btn btn-secondary fload-end" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-arrow-left"></i> Kembali</button>
                      </div>
                      <div class="col text-end">
                          <button class="btn btn-primary fload-end" type="submit"><i class="fa fa-floppy-o"></i> Simpan </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>
@endsection


@push('jsTambahan')
<script src="{{ asset('/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('/assets/js/chart/apex-chart/moment.min.js') }}"></script>

<script>
    setInterval(() => {
        let date = new Date()
        let jam = date.getHours();
        let menit = date.getMinutes();

        console.log(jam)

        if(jam < 11){
            $('#waktu').text('Pagi')
        }else if(jam >= 11 && jam < 15){
            $('#waktu').text('Siang')
        }else if(jam >= 15 && jam < 18){
            $('#waktu').text('Sore')
        }else if(jam >= 18){
            $('#waktu').text('Malam')
        }

        $('#jam').text(`${(jam < 10) ? 0 : ''}${jam}`);
        $('#menit').text(`${(menit < 10) ? 0 : ''}${menit}`);
    }, 1000);

    const formatRupiah = (nominal) =>{
        return new Intl.NumberFormat("id-ID", {
                       style: "currency",
                       currency: "IDR"
                }).format(nominal);
    }

    let delay = null;
    $('#nominal').on('keyup', (s) =>{
        clearTimeout(delay);
        const nominal = s.target.value * 1000;
        const rupiah = formatRupiah(nominal)

        delay = setTimeout(() => {
            if(isNaN(s.target.value) || s.target.value <= 0){
                $('#nominal').val('')
            }else{
                $('#saldo_nominal').val(nominal);
                $('#nominal').val(rupiah)
            }
        }, 500);
    })

    const input = (url, judul) =>{
      $('#formModal').modal('show')
      $('#judulModal').text(judul)
      $('#formData').attr('action', url)

      if(judul == 'Saldo Masuk'){
        $('#saldo_masuk').removeClass('d-none')
        $('#saldo_keluar').addClass('d-none')
        $('#jenis_saldo_masuk').attr('name', 'saldo_jenis')
        $('#jenis_saldo_keluar').attr('name', '')
      }else{
        $('#saldo_masuk').addClass('d-none')
        $('#saldo_keluar').removeClass('d-none')
        $('#jenis_saldo_masuk').attr('name', '')
        $('#jenis_saldo_keluar').attr('name', 'saldo_jenis')
      }
    }

    const bantuanNominal = (nominal) =>{
        $('#saldo_nominal').val(nominal);
        $('#nominal').val(formatRupiah(nominal))
    }

    //chart masuk perbulan
    // const dataSpt = @json($masukPerbulan);
    // const bulan = Object.entries(@json($arr_bulan));
    // var options = {
    //       series: [{
    //       name: 'Saldo Masuk',
    //       data: bulan.map(val => dataSpt[val[0]] ?? 0)
    //     }],
    //       chart: {
    //       height: window.innerHeight / 2,
    //       type: 'area',
    //     },
    //     plotOptions: {
    //       bar: {
    //         borderRadius: 10,
    //         dataLabels: {
    //           position: 'top', // top, center, bottom
    //         },
    //       }
    //     },
    //     dataLabels: {
    //       enabled: true,
    //       formatter: function (val) {
    //         return val;
    //       },
    //       offsetY: -20,
    //       style: {
    //         fontSize: '12px',
    //         colors: ["#304758"]
    //       }
    //     },     
    //     xaxis: {
    //       categories: bulan.map(val => val[1]),
    //       position: 'top',
    //       axisBorder: {
    //         show: false
    //       },
    //       axisTicks: {
    //         show: false
    //       },
    //       crosshairs: {
    //         fill: {
    //           type: 'gradient',
    //           gradient: {
    //             colorFrom: '#D8E3F0',
    //             colorTo: '#BED1E6',
    //             stops: [0, 100],
    //             opacityFrom: 0.4,
    //             opacityTo: 0.5,
    //           }
    //         }
    //       },
    //       tooltip: {
    //         enabled: true,
    //       }
    //     },
    //     yaxis: {
    //       axisBorder: {
    //         show: false
    //       },
    //       axisTicks: {
    //         show: false,
    //       },
    //       labels: {
    //         show: false,
    //         formatter: function (val) {
    //           return `Rp ${val}`;
    //         }
    //       }
        
    //     },
    //     title: {
    //       text: 'Total Saldo Masuk PerBulan',
    //       floating: true,
    //       offsetY: window.innerHeight / 2.09,
    //       align: 'center',
    //       style: {
    //         color: '#444'
    //       }
    //     }
    //     };

    //     var chart = new ApexCharts(document.querySelector("#chart"), options);
    //     chart.render();

    //chart keluar perbulan
    // const dataKeluar = @json($keluarPerbulan);
    // var options = {
    //       series: [{
    //       name: 'Saldo Keluar',
    //       data: bulan.map(val => dataKeluar[val[0]] ?? 0)
    //     }],
    //       chart: {
    //       height: window.innerHeight / 2,
    //       type: 'area',
    //     },
    //     plotOptions: {
    //       bar: {
    //         borderRadius: 10,
    //         dataLabels: {
    //           position: 'top', // top, center, bottom
    //         },
    //       }
    //     },
    //     dataLabels: {
    //       enabled: true,
    //       formatter: function (val) {
    //         return val;
    //       },
    //       offsetY: -20,
    //       style: {
    //         fontSize: '12px',
    //         colors: ["#304758"]
    //       }
    //     },     
    //     xaxis: {
    //       categories: bulan.map(val => val[1]),
    //       position: 'top',
    //       axisBorder: {
    //         show: false
    //       },
    //       axisTicks: {
    //         show: false
    //       },
    //       crosshairs: {
    //         fill: {
    //           type: 'gradient',
    //           gradient: {
    //             colorFrom: '#D8E3F0',
    //             colorTo: '#BED1E6',
    //             stops: [0, 100],
    //             opacityFrom: 0.4,
    //             opacityTo: 0.5,
    //           }
    //         }
    //       },
    //       tooltip: {
    //         enabled: true,
    //       }
    //     },
    //     yaxis: {
    //       axisBorder: {
    //         show: false
    //       },
    //       axisTicks: {
    //         show: false,
    //       },
    //       labels: {
    //         show: false,
    //         formatter: function (val) {
    //           return `Rp ${val}`;
    //         }
    //       }
        
    //     },
    //     title: {
    //       text: 'Total Saldo Keluar PerBulan',
    //       floating: true,
    //       offsetY: window.innerHeight / 2.09,
    //       align: 'center',
    //       style: {
    //         color: '#444'
    //       }
    //     }
    //     };

    //     var keluar = new ApexCharts(document.querySelector("#saldoKeluar"), options);
    //     keluar.render();

    const bulan = Object.entries(@json($arr_bulan));
    const dataSpt = @json($masukPerbulan);
    const dataKeluar = @json($keluarPerbulan);
        var options = {
          series: [{
          name: 'Uang Masuk',
          data:  bulan.map(val => dataSpt[val[0]] ?? 0)
        }, {
          name: 'Uang Keluar',
          data:  bulan.map(val => dataKeluar[val[0]] ?? 0)
        }],
          chart: {
          height:  window.innerHeight / 2,
          type: 'area'
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          categories: bulan.map(val => val[1])
        },
        colors: ['#2E93fA', '#eb3434'],
        // tooltip: {
        //   x: {
        //     format: 'dd/MM/yy HH:mm'
        //   },
        // },
        };

        var chart = new ApexCharts(document.querySelector("#perBulan"), options);
        chart.render();

        const tahun = @json($tahun);
        const jenisSaldoMasuk = @json($jenis_saldo_masuk);
        const jenisSaldoKeluar = @json($jenis_saldo_keluar);
        const dataPerJenis = @json($saldoPerJenis);
        const saldoMasuk = dataPerJenis.filter((e) => e.saldo_status == 'masuk');
        const saldoKeluar = dataPerJenis.filter((e) => e.saldo_status == 'keluar');

        if(saldoMasuk.length == 0){
          $('#chart1').toggleClass('d-none')
          $('#none1').toggleClass('d-none')
        }
        let jenis = [];
        $.each(jenisSaldoMasuk, (i,v)=>{
          jenis[v.jenis_saldo_masuk_id] = v.jenis_saldo_masuk_nama
        })
        var options = {
          series: saldoMasuk.map(val => val.jumlah),
          chart: {
          height: 300,
          type: 'pie',
        },
        labels: saldoMasuk.map(val => jenis[val.saldo_jenis]),
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 350
            },
            legend: {
              position: 'bottom'
            }
          }
        }],
        title: {
          text: `Uang Masuk Berdasarkan Jenis -- ${tahun}`,
          floating: true,
          offsetY: -5,
          align: (window.innerWidth > 700) ? 'left' : 'center',
          style: {
            color: '#444',
            fontSize: 13,
            fontWeight: 600
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();


        if(saldoKeluar.length == 0){
          $('#chart2').toggleClass('d-none')
          $('#none2').toggleClass('d-none')
        }
        let jenis2 = [];
        $.each(jenisSaldoKeluar, (i,v)=>{
          jenis2[v.jenis_saldo_keluar_id] = v.jenis_saldo_keluar_nama
        })
        var options = {
          series: saldoKeluar.map(val => val.jumlah),
          chart: {
          height: 300,
          type: 'pie',
        },
        labels: saldoKeluar.map(val => jenis2[val.saldo_jenis]),
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 350
            },
            legend: {
              position: 'bottom'
            }
          }
        }],
        title: {
          text: `Uang Keluar Berdasarkan Jenis -- ${tahun}`,
          floating: true,
          offsetY: -5,
          align: (window.innerWidth > 700) ? 'left' : 'center',
          style: {
            color: '#444',
            fontSize: 13,
            fontWeight: 600
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart2"), options);
        chart.render();
</script>
@endpush