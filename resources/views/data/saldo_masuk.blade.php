@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection

@php
$user = App\Models\User::class;
@endphp

@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div style="display: flex; justify-content: space-between">
            <div >
                <span class="f-30 f-w-400"><i class="icon-layers sembunyikan"></i> {{$judulPage}} -- {{$bulan}} {{$tahun}}</span>
            </div>
            <div >
                <div class="mx-2 mt-2">
                    <button class="btn btn-primary" type="button" onclick="filter()"><i class="fa fa-search"></i> <span class="sembunyikan">Search</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col">
            <div style="display: flex; justify-content: flex-end; padding-right: 5%">
                <p class="text-center">
                    <span style="font-size: 15px; font-weight: 500">Saldo Saat Ini</span>
                    <br>
                    <strong style="font-size: 17px;">Rp {{number_format($saldo_terakhir->saldo_total ?? 0, 0, ",", ".")}}</strong>
                </p>
            </div>
            <div class="card">
                <div class="table-responsive signal-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Penanggung Jawab</th>
                                <th>Keterangan</th>
                                {{-- <th>Status</th> --}}
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                {{-- <th>Saldo Terakhir</th> --}}
                                @if(Auth::user()->can('admin', $user) || Auth::user()->can('bendahara', $user))                                   
                                  <th  class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="add()"><i class="icon-pencil-alt"></i> Tambah</button></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val->user->user_nama ?? ''}}</td>
                                <td>{{$val->saldo_keterangan}}</td>
                                {{-- <td>{{ucFirst($val->saldo_status)}}</td> --}}
                                <td>
                                    {{$val->jenis_saldo_masuk_nama}}
                                    <br>
                                    {{$val->jenis_iuran_nama}}
                                </td>
                                <td>{{fAnaTgl($val->saldo_tgl, 'hri, tgl bln thn')}}</td>
                                <td align="right">{{number_format($val->saldo_nominal, 0, ",", ".")}}</td>
                                {{-- <td>{{number_format($val->saldo_total, 0, ",", ".")}}</td> --}}
                                @if(Auth::user()->can('admin', $user) || Auth::user()->can('bendahara', $user))
                                <td class="d-flex d-row justify-content-center">
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val}})" {{$val->jenis_saldo_masuk_nama == 'Iuran' ? 'Disabled' : ''}}><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> saldo_id}}, `{{$val -> saldo_nama}}`)'><i class="fa fa-times"></i> Hapus</button>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            <div class="col-md-12">
                                <label class="form-label" for="saldo_jenis">Jenis Saldo</label>
                                <select id="saldo_jenis" class="form-select form-select-sm" aria-label=".form-select-sm example" name="saldo_jenis">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_saldo_masuk as $val)
                                    <option value="{{$val->jenis_saldo_masuk_id}}">{{$val->jenis_saldo_masuk_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="jenis_iuran_id">Jenis Iuran</label>
                                <select id="jenis_iuran_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name="jenis_iuran_id">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_iuran as $val)
                                    <option value="{{$val->jenis_iuran_id}}">{{$val->jenis_iuran_nama}}</option>
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

<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-toggle-wrapper">
                    <ul class="modal-img">
                        <li> <img src="{{asset('assets/images/gif/danger.gif')}}" alt="error"></li>
                    </ul>
                    <h4 class="text-center pb-2">Peringatan !!!</h4>
                    <p class="text-center">Konfirmasi penghapusan data ?</p>
                    <p class="text-lg-center" id="textHapus"></p>
                    <form id="formHapus" method="POST">
                        @csrf
                        <button class="btn btn-danger d-flex m-auto" type="submit"><i class="fa fa-times-circle mt-1 me-1"></i> Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Filter --}}
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-toggle-wrapper text-start dark-sign-up">
                <form id="formFilter" class=" needs-validation" novalidate="" method="GET">
                    <input type="hidden" name="action" id="action">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span id="judulModal">Filter Data</span></h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="fsaldo_keterangan">Keterangan</label>
                                <input class="form-control" id="fsaldo_keterangan" type="text" placeholder="Masukkan Keterangan..." name="saldo_keterangan">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fjenis_saldo_masuk_nama">Jenis Saldo</label>
                                <select id="fjenis_saldo_masuk_nama" class="form-select form-select-sm" aria-label=".form-select-sm example" name="jenis_saldo_masuk_nama">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_saldo_masuk as $val)
                                    <option value="{{$val->jenis_saldo_masuk_nama}}">{{$val->jenis_saldo_masuk_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fbulan">Bulan</label>
                                <select id="fbulan" class="form-select form-select-sm" aria-label=".form-select-sm example" name="bulan">
                                    <option value="">--Pilih--</option>
                                    @foreach ($arr_bulan as $key => $val)
                                    <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="ftahun">Tahun</label>
                                <select id="ftahun" class="form-select form-select-sm" aria-label=".form-select-sm example" name="tahun">
                                    <option value="">--Pilih--</option>
                                    @foreach ($arr_tahun as $key => $val)
                                    <option value="{{$val}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col">
                            <a class="btn btn-secondary fload-end" href="{{$baseURL}}"><i class="fa fa-rotate-left me-1"></i></i>Reset</a>
                        </div>
                        <div class="col text-end">
                            <button class="btn btn-primary fload-end" type="submit"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

@push('jsTambahan')
<script>
    const baseUrl = "{{$baseURL}}"

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

    const bantuanNominal = (nominal) =>{
        $('#saldo_nominal').val(nominal);
        $('#nominal').val(formatRupiah(nominal))
    }

    const add = () => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/addData`);
        $('#judulModal').text('Tambah Data');
        $('#saldo_keterangan').val("");
        $('#saldo_tgl').val("");
        $('#nominal').val("");
        $('#saldo_nominal').val("");
        $('#saldo_jenis').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/updateData/${data.saldo_id}`);
        $('#judulModal').text('Update Data');
        $('#old_saldo').val(data.saldo_nominal)
        $('#nominal').val(data.saldo_nominal)
        $.each(data, (i, val) =>{
            $(`#${i}`).val(val)
        })
    }

    const hapus = (id, text) => {
        $('#hapusModal').modal('show');
        $('#textHapus').text(text)
        $('#formHapus').attr('action', `${baseUrl}/dellData/${id}`)
    }

    const filter = () =>{
        $('#action').val('')
        $('#searchModal').modal('show')
    }

    const download = () =>{
        $('#action').val('download')
        $('#formFilter').submit()
    }

    const filterVal = @json($filterVal);
    if(filterVal){
        $.each(filterVal, (key, value) => {
            $(`#f${key}`).val(value)
        })
    }
</script>
@endpush