@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="d-flex flex-wrap justify-content-between">
            <div>
                <span class="f-30 f-w-400"><i class="icon-layers sembunyikan"></i> {{$judulPage}}</span>
            </div>
            <div>
                <div class="d-flex flex-wrap">
                    <form class="mx-2" action="{{$baseURL}}" id="formSearch">
                        <div style="position: relative;">
                            <input class="form-control" id="fjenis_saldo_keluar_nama" type="text" placeholder="Cari Nama jenis Saldo Keluar..." required="" name="jenis_saldo_keluar_nama" value="{{(isset($vFilter['jenis_saldo_keluar_nama'])) ? $vFilter['jenis_saldo_keluar_nama'] : ''}}">
                            <a href="{{$baseURL}}" class="{{(!isset($vFilter['jenis_saldo_keluar_nama'])) ? 'd-none' : ''}}">                          
                                <span style="position: absolute; top: 20%; right: 10px;">X</span>
                            </a>
                        </div>
                    </form>
                    <div class="mx-2">
                        <button class="btn btn-primary" type="button" onclick="$('#formSearch').submit()"><i class="fa fa-search"></i> <span class="sembunyikan">Search</span></button>
                    </div>
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
                                <th class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="add()"><i class="icon-pencil-alt"></i> Tambah</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val->jenis_saldo_keluar_nama}}</td>
                                <td>
                                    add : {{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}
                                    <br>
                                    upd :{{fAnaTgl($val->updated_at, 'jam:mnt - hri, tgl bln thn')}}
                                </td>
                                <td align="center">
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> jenis_saldo_keluar_id}}, `{{$val -> jenis_saldo_keluar_nama}}`)'><i class="fa fa-times"></i> Hapus</button>
                                    </div>
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
                                <label class="form-label" for="jenis_saldo_keluar_nama">Nama</label>
                                <input class="form-control" id="jenis_saldo_keluar_nama" type="text" placeholder="Nama jenis_saldo_keluar..." required="" name="jenis_saldo_keluar_nama">
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
                    <p class="text-center" id="textHapus"></p>
                    <form id="formHapus" method="POST">
                        @csrf
                        <button class="btn btn-danger d-flex m-auto" type="submit"><i class="fa fa-times-circle mt-1 me-1"></i> Hapus</button>
                    </form>
                </div>
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
        $('#jenis_saldo_keluar_nama').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/updateData/${data.jenis_saldo_keluar_id}`);
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
</script>
@endpush