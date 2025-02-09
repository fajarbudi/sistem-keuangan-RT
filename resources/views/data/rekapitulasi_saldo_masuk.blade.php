@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


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
                    <span style="font-size: 15px; font-weight: 500">Total Uang Masuk</span>
                    <br>
                    <strong style="font-size: 17px;">Rp {{number_format($total_saldo_masuk ?? 0, 0, ",", ".")}}</strong>
                </p>
            </div>
            <div class="card">
                <div class="table-responsive signal-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                {{-- <th>Status</th> --}}
                                <th>Keterangan</th>
                                <th>Jenis</th>
                                <th>Tanggal</th>
                                <th>Nominal</th>
                                {{-- <th>Saldo Terakhir</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                {{-- <td>{{ucFirst($val->saldo_status)}}</td> --}}
                                <td>{{$val->saldo_keterangan}}</td>
                                <td>
                                    {{$val->jenis_saldo_masuk_nama}}
                                    <br>
                                    {{$val->jenis_iuran_nama}}
                                </td>
                                <td>{{fAnaTgl($val->saldo_tgl, 'hri, tgl bln thn')}}</td>
                                <td>{{number_format($val->saldo_nominal, 0, ",", ".")}}</td>
                                {{-- <td>{{number_format($val->saldo_total, 0, ",", ".")}}</td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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