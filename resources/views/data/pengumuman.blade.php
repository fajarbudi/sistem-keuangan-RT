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
                            <input class="form-control" id="fpengumuman_judul" type="text" placeholder="Cari Nama pengumuman..." required="" name="pengumuman_judul" value="{{(isset($vFilter['pengumuman_judul'])) ? $vFilter['pengumuman_judul'] : ''}}">
                            <a href="{{$baseURL}}" class="{{(!isset($vFilter['pengumuman_judul'])) ? 'd-none' : ''}}">                          
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
                                <th class="wi45p">Judul/Keterangan</th>
                                <th>Gambar</th>
                                <th>PDF</th>
                                <th>Tipe</th>
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
                                    <strong>{{$val->pengumuman_judul}}</strong>
                                    <br/>
                                    {{$val->pengumuman_isi}}
                                </td>
                                <td>
                                    <button onclick="show('{{url('storage/'.$val->pengumuman_gambar)}}')" {{!$val->pengumuman_gambar ? 'disabled' : ''}} class="btn btn-success">View</button>
                                </td>
                                <td>
                                    <button onclick="show('{{url('storage/'.$val->pengumuman_pdf)}}')" {{!$val->pengumuman_pdf ? 'disabled' : ''}} class="btn btn-success">View</button>
                                </td>
                                <td>{{$val->pengumuman_tipe}}</td>
                                @can('admin', App\Models\User::class)
                                    <td>{{$val->pengumuman_urutan}}</td>
                                    <td>{{$val->pengumuman_publikasi}}</td>
                                @endcan
                                @can('admin', App\Models\User::class)
                                <td>
                                    {{fAnaTgl($val->updated_at, 'jam:mnt - hri, tgl bln thn')}}
                                    <br>
                                    {{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}
                                </td>
                                <td class="d-flex d-row justify-content-center">
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> pengumuman_id}}, `{{$val -> pengumuman_judul}}`)'><i class="fa fa-times"></i> Hapus</button>
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
                                <label class="form-label" for="pengumuman_judul">Judul</label>
                                <input class="form-control" id="pengumuman_judul" type="text" placeholder="Masukkan Judul..." required="" name="pengumuman_judul">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_isi">Keterangan</label>
                                <textarea name="pengumuman_isi" id="pengumuman_isi" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_gambar">Gambar</label>
                                <input class="form-control" id="pengumuman_gambar" type="file" placeholder="Masukkan Gambar..." required="" name="pengumuman_gambar">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_pdf">PDF</label>
                                <input class="form-control" id="pengumuman_pdf" type="file" placeholder="Masukkan PDF..." required="" name="pengumuman_pdf">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_urutan">Urutan</label>
                                <input class="form-control" id="pengumuman_urutan" type="number" min="1" placeholder="Masukkan Urutan..." required="" name="pengumuman_urutan">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_tipe">Tipe</label>
                                <select id="pengumuman_tipe" class="form-select form-select-sm" aria-label=".form-select-sm example" name="pengumuman_tipe">
                                    <option value="">--Pilih--</option>
                                    <option value="Pengumuman">Pengumuman</option>
                                    <option value="Running Text">Running Text</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_publikasi">Publikasi</label>
                                <select id="pengumuman_publikasi" class="form-select form-select-sm" aria-label=".form-select-sm example" name="pengumuman_publikasi">
                                    <option value="">--Pilih--</option>
                                    <option value="Ya">Ya</option>
                                    <option value="Tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="pengumuman_popup">Utama / Penting (Popup)</label>
                                <select id="pengumuman_popup" class="form-select form-select-sm" aria-label=".form-select-sm example" name="pengumuman_popup">
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
        $('#pengumuman_judul').val("");
        $('#pengumuman_urutan').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/updateData/${data.pengumuman_id}`);
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