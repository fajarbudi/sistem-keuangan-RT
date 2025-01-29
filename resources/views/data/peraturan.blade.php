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
                            <input class="form-control" id="fperaturan_judul" type="text" placeholder="Cari Nama peraturan..." required="" name="peraturan_judul" value="{{(isset($vFilter['peraturan_judul'])) ? $vFilter['peraturan_judul'] : ''}}">
                            <a href="{{$baseURL}}" class="{{(!isset($vFilter['peraturan_judul'])) ? 'd-none' : ''}}">                          
                                <span style="position: absolute; top: 20%; right: 10px;">X</span>
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
                                <th class="wi45p">Judul/Keterangan</th>
                                <th>Gambar</th>
                                <th>PDF</th>
                                @can('admin', App\Models\User::class)
                                    <th>Urutan</th>
                                    <th>Publikasi</th>
                                @endcan
                                <th>Diupdate/Dibuat</th>
                                @can('admin', App\Models\User::class)
                                <th class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="add()"><i class="icon-pencil-alt"></i> Tambah</button></th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>
                                    <strong>{{$val->peraturan_judul}}</strong>
                                    <br/>
                                    {{$val->peraturan_isi}}
                                </td>
                                <td>
                                    <button onclick="show('{{url('storage/'.$val->peraturan_gambar)}}')" {{!$val->peraturan_gambar ? 'disabled' : ''}} class="btn btn-success">View</button>
                                </td>
                                <td>
                                    <button onclick="show('{{url('storage/'.$val->peraturan_pdf)}}')" {{!$val->peraturan_pdf ? 'disabled' : ''}} class="btn btn-success">View</button>
                                </td>
                                @can('admin', App\Models\User::class)
                                    <td>{{$val->peraturan_urutan}}</td>
                                    <td>{{$val->peraturan_publikasi}}</td>
                                @endcan
                                <td>
                                    {{fAnaTgl($val->updated_at, 'jam:mnt - hri, tgl bln thn')}}
                                    <br />
                                    {{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}
                                </td>
                                @can('admin', App\Models\User::class)
                                <td class="d-flex d-row justify-content-center">
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> peraturan_id}}, `{{$val -> peraturan_judul}}`)'><i class="fa fa-times"></i> Hapus</button>
                                    </div>
                                </td>
                                @endcan
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-toggle-wrapper text-start dark-sign-up">
                <form id="formData" class=" needs-validation" novalidate="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span id="judulModal">Tambah Data</span></h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_judul">Judul</label>
                                <input class="form-control" id="peraturan_judul" type="text" placeholder="Masukkan Judul..." required="" name="peraturan_judul">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_isi">Keterangan</label>
                                <textarea name="peraturan_isi" id="peraturan_isi" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_gambar">Gambar</label>
                                <input class="form-control" id="peraturan_gambar" type="file" placeholder="Masukkan Gambar..." required="" name="peraturan_gambar">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_pdf">PDF</label>
                                <input class="form-control" id="peraturan_pdf" type="file" placeholder="Masukkan PDF..." required="" name="peraturan_pdf">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_urutan">Urutan</label>
                                <input class="form-control" id="peraturan_urutan" type="number" min="1" placeholder="Masukkan Urutan..." required="" name="peraturan_urutan">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_publikasi">Publikasi</label>
                                <select id="peraturan_publikasi" class="form-select form-select-sm" aria-label=".form-select-sm example" name="peraturan_publikasi">
                                    <option value="">--Pilih--</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="peraturan_popup">Utama / Penting (Popup)</label>
                                <select id="peraturan_popup" class="form-select form-select-sm" aria-label=".form-select-sm example" name="peraturan_popup">
                                    <option value="">--Pilih--</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
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
    const baseUrl = "{{$baseURL}}"

    const add = () => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/addData`);
        $('#judulModal').text('Tambah Data');
        $('#peraturan_judul').val("");
        $('#peraturan_urutan').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/updateData/${data.peraturan_id}`);
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

    const show = (url) =>{
        $('#fileShowModal').modal('show')
        $('#fileShow').attr('src', `${url}`)
    }
</script>
@endpush