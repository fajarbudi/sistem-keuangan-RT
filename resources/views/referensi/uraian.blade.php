@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="d-flex flex-wrap justify-content-between">
            <div>
                <span class="f-30 f-w-400"><i class="icon-layers"></i> {{$judulPage}}</span>
            </div>
            <div>
                <div class="d-flex flex-wrap">
                    <form class="mx-2" action="{{$baseURL}}" id="formSearch">
                        <div style="position: relative;">
                            <input class="form-control" id="furaian" type="text" placeholder="Cari Uraian..." required="" name="uraian" value="{{(isset($vFilter['uraian'])) ? $vFilter['uraian'] : ''}}">
                            <a href="{{$baseURL}}" class="{{(!isset($vFilter['uraian'])) ? 'd-none' : ''}}">                          
                                <span style="position: absolute; top: 10%; right: 10px;" class="fs-5">X</span>
                            </a>
                        </div>
                    </form>
                    <div class="mx-2">
                        <button class="btn btn-primary" type="button" onclick="$('#formSearch').submit()"><i class="fa fa-search"></i> Search</button>
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
                                <th>Uraian</th>
                                <th>Jenis</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="add()"><i class="icon-pencil-alt"></i> Tambah</button></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val->uraian}}</td>
                                <td>{{$val->jenis_dokumen}}</td>
                                <td>{{fAnaTgl($val->updated_at, 'jam:mnt - hri, tgl bln thn')}}</td>
                                <td>{{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}</td>
                                <td class="d-flex d-row justify-content-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update('{{route('uraian.update',['id' => $val->uraian_id])}}', {{$val}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> uraian_id}}, `{{$val -> uraian}}`)'><i class="fa fa-times"></i> Hapus</button>
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
                                <label class="form-label" for="urian">Uraian</label>
                                <textarea class="form-control" id="uraian" name="uraian"></textarea>
                                <div class="valid-feedback">Sesuai...</div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="jenis_dokumen">Jenis</label>
                                <select class="form-control form-select form-select-sm" aria-label="form-select-sm example" name="jenis_dokumen" id="jenis_dokumen">
                                    <option value="">--Pilih--</option>
                                    @foreach ($arr_jenis_dokumen as $key => $val)
                                    <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                                <div class="valid-feedback">Looks good!</div>
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

</div>
@endsection

@push('jsTambahan')
<script>
    const baseUrl = '{{$baseURL}}';

    const add = () => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/addData`);
        $('#judulModal').text('Tambah Data');
        $('#uraian').val("");
        $('input[type="text"],input[type="number"],select').val("");
    }

    const update = (url, data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${url}`);
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