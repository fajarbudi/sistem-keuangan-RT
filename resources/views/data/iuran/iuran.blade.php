@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div style="display: flex; justify-content: space-between">
            <div >
                <span class="f-30 f-w-400"><i class="icon-layers"></i> {{$judulPage}}</span>
            </div>
            <div >
                <div class="mx-2 mt-2">
                    <button class="btn btn-primary" type="button" onclick="filter()"><i class="fa fa-search"></i> Search</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col">
            <div class="card">
                <div class="table-responsive signal-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val->pertemuan_nama}}</td>
                                <td>{{fAnaTgl($val->pertemuan_tgl, 'hri, tgl bln thn')}}</td>
                                <td align="center">
                                    <a class="btn btn-primary" href="{{route('iuran.detail', $val->pertemuan_id)}}"><i class="fa fa-sign-in me-1"></i>Detail</a>
                                </td>
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
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="pertemuan_nama">Nama</label>
                                <input class="form-control" id="pertemuan_nama" type="text" placeholder="Masukkan Nama Pertemuan..." required="" name="pertemuan_nama">
                            </div>
                            {{-- <div class="col-md-12">
                                <label class="form-label" for="jenis_iuran_id">Jenis Iuran</label>
                                <select id="jenis_iuran_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name="jenis_iuran_id">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_iuran as $val)
                                    <option value="{{$val->jenis_iuran_id}}">{{$val->jenis_iuran_nama}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-12">
                                <label class="form-label" for="pertemuan_tgl">Tanggal</label>
                                <input class="form-control digits" id="pertemuan_tgl" type="date" data-date-format="YYYY-mm-dd" required="" name="pertemuan_tgl">
                                <div class="invalid-feedback">Isian tidak sesuai...</div>
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
                                <label class="form-label" for="fpertemuan_nama">Nama</label>
                                <input class="form-control" id="fpertemuan_nama" type="text" placeholder="Masukkan Nama Pertemuan..." name="pertemuan_nama">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fjenis_iuran_id">Jenis pertemuan</label>
                                <select id="fjenis_iuran_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name="jenis_iuran_id">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_iuran as $val)
                                    <option value="{{$val->jenis_iuran_id}}">{{$val->jenis_iuran_nama}}</option>
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

    const add = () => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/addData`);
        $('#judulModal').text('Tambah Data');
        $('#pertemuan_nama').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/updateData/${data.pertemuan_id}`);
        $('#judulModal').text('Update Data');
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