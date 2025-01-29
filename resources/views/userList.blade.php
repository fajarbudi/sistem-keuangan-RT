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
        <div>
                <div class="mx-2">
                    <button class="btn btn-primary" type="button" onclick="$('#searchModal').modal('show')"><i class="fa fa-search"></i> Search</button>
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
                                <th>Username</th>
                                <th>Jabatan</th>
                                <th>Golongan</th>
                                <th>Role</th>
                                {{-- <th>Tanggal</th> --}}
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val->user_nama}}</td>
                                <td>{{$val->user_username}}</td>
                                <td>{{$val->pegawai->ref_jabatan->jabatan_nama ?? ''}}</td>
                                <td>{{$val->pegawai->ref_golongan->golongan_nama ?? ''}}</td>
                                <td>{{$val->user_role}}</td>
                                {{-- <td>
                                    Up: {{fAnaTgl($val->updated_at, 'jam:mnt - hri, tgl bln thn')}}
                                    <br />
                                    On: {{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}
                                </td> --}}
                                <td align="center">
                                    <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val->user_id}})"><i class="fa fa-pencil-square-o"></i>Ubah Role</button>
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
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span id="judulModal">Ubah Role</span></h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="user_role">Role User</label>
                                <select id="user_role" class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_role">
                                    <option value="">--Pilih--</option>
                                    @foreach ($user_role as $key=> $val)
                                    <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
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
{{-- Modal Filter --}}
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-toggle-wrapper text-start dark-sign-up">
                <form id="formData" class=" needs-validation" novalidate="" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span id="judulModal">Filter Data</span></h5>
                        <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_nama">Nama</label>
                                <input class="form-control" id="fuser_nama" type="text" placeholder="Masukkan Nama user..." required="" name="user_nama">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_username">Username</label>
                                <input class="form-control" id="fuser_username" type="text" placeholder="Masukkan Username user..." required="" name="user_username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_role">Role User</label>
                                <select id="fuser_role" class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_role">
                                    <option value="">--Pilih--</option>
                                    @foreach ($user_role as $key=> $val)
                                    <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fjabatan">Jabatan</label>
                                <select id="fjabatan" class="form-select form-select-sm" aria-label=".form-select-sm example" name="jabatan_nama">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jabatan as $key=> $val)
                                    <option value="{{$val->jabatan_nama}}">{{$val->jabatan_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fgolongan">Golongan</label>
                                <select id="fgolongan" class="form-select form-select-sm" aria-label=".form-select-sm example" name="golongan_nama">
                                    <option value="">--Pilih--</option>
                                    @foreach ($golongan as $key=> $val)
                                    <option value="{{$val->golongan_nama}}">{{$val->golongan_nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col">
                            <a class="btn btn-secondary fload-end" href="{{$baseURL}}"><<i class="fa fa-rotate-left me-1"></i>Reset</a>
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
    const baseURL = '{{$baseURL}}'

    const update = (id) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseURL}/updateData/${id}`);
    }
</script>
@endpush