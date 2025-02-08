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
            <div class="mx-2">
                <button class="btn btn-primary mt-2" type="button" onclick="$('#searchModal').modal('show')"><i class="fa fa-search"></i> Search</button>
            </div>
        </div>
       </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col">
            <div class="card">
                <div class="table-responsive signal-table tabelData">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th class="text-center">Foto</th>
                                <th>Nama Lengkap</th>
                                @can('admin', App\Models\User::class)
                                <th>Username</th>
                                @endcan
                                <th>Email</th>
                                <th>Handphone</th>
                                <th>Golongan Darah</th>
                                <th>Role</th>
                                @can('admin', App\Models\User::class)
                                <th class="text-center">
                                    <button class="btn btn-sm btn-danger mt-2" type="button" onclick="add()"><i class="icon-pencil-alt"></i> Tambah</button>
                                </th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            @php
                            $mulaiNo++;
                        @endphp
                            <tr>
                                <th scope="row">{{$mulaiNo}}</th>
                                {{-- <td>{{$val->user_no}}</td> --}}
                                <td>
                                    <form id="{{'formCover'. $val->user_id}}" action="{{ route('warga.foto') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" class="d-none" id="{{'kontenGambar'. $val->user_id}}" name="user_foto">
                                        <input type="hidden" name="id" value="{{$val->user_id}}">
                                    </form>
                                    <div style="display: flex; flex-direction: column; align-items: center">
                                        <img src="{{($val->user_foto) ? url('storage/'.$val->user_foto) : asset('assets/images/add-image.png')}}" alt="" width="100px">
                                      
                                        @can('admin', App\Models\User::class)                                       
                                           <button style="background-color: rgb(4, 173, 4)" onclick="$('{{'#kontenGambar'. $val->user_id}}').trigger('click')" class="btn btn-sm btn-primary mt-2">{{($val->user_foto) ? 'Update' : 'Upload'}}</button>
                                        @endcan
                                    </div>
                                </td>
                                <td>{{$val->user_nama}}</td>
                                @can('admin', App\Models\User::class)                             
                                  <td>{{$val->user_username}}</td>
                                @endcan
                                <td>{{$val->user_email}}</td>
                                <td>{{$val->user_Telp}}</td>
                                <td>{{strtoupper($val->user_gol_darah)}}</td>
                                <td>{{$val->user_role}}</td>
                                @can('admin', App\Models\User::class)                                  
                                <td align="center">
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{json_encode($val)}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus("{{$val -> user_id}}", `{{$val -> user_nama}}`)'><i class="fa fa-times"></i> Hapus</button>
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
    <div class="mb-3">
        {{ $data->onEachSide(5)->links() }}
    </div>
</div>

{{-- Modal Tambah dan Update --}}
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="user_nama">Nama Lengkap</label>
                                    <input class="form-control" id="user_nama" type="text" placeholder="Masukkan Nama ..." required="" name="user_nama">
                                </div>
                                @can('admin', App\Models\User::class)                            
                                  <div class="col-md-6">
                                    <label class="form-label" for="user_username">Username</label>
                                    <input class="form-control" id="user_username" type="text" placeholder="Masukkan Username ..." required="" name="user_username">
                                  </div>
                                @endcan
                                <div class="col-md-6">
                                    <label class="form-label" for="user_email">Email</label>
                                    <input class="form-control" id="user_email" type="text" placeholder="Masukkan Email ..." required="" name="user_email">
                                </div>
                                @if (Auth::user()->user_role == 'superAdmin')
                                <div class="col-md-6">
                                    <label class="form-label" for="password">Password User</label>
                                    <input class="form-control" id="password" type="password" placeholder="Masukkan Password..." required="" name="password">
                                </div>
                                @endif
                                <div class="col-md-6">
                                    <label class="form-label" for="user_Telp">No Telphone</label>
                                    <input class="form-control" id="user_Telp" type="text" placeholder="Masukkan No Telphone ..." required="" name="user_Telp">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="user_gol_darah">Golongan Darah</label>
                                    <select id="user_gol_darah" class="form-select form-select-sm" name="user_gol_darah">
                                        <option value="" selected>--Pilih--</option>
                                        @foreach ($golongan_darah as $key => $val)
                                            <option value="{{$key}}">{{$val}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @can('admin', App\Models\User::class)
                                <div class="col-md-6">
                                    <label class="form-label" for="user_role">Role</label>
                                    <select id="user_role" class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_role">
                                        <option value="">--Pilih--</option>
                                        @foreach ($user_role as $key => $val)
                                           @if ($key != 'superAdmin')
                                           <option value="{{$key}}">{{$val}}</option>
                                           @endif
                                        @endforeach
                                    </select>
                                </div>
                                @endcan
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
                                <label class="form-label" for="fuser_username">Username </label>
                                <input class="form-control" id="fuser_username" type="text" placeholder="Masukkan username ..." required="" name="user_username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_email">Email</label>
                                <input class="form-control" id="fuser_email" type="text" placeholder="Masukkan Email ..." required="" name="user_email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_Telp">No Telphone</label>
                                <input class="form-control" id="fuser_Telp" type="text" placeholder="Masukkan No Handphone ..." required="" name="user_Telp">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_gol_darah">Golongan Darah</label>
                                <select id="fuser_gol_darah" class="form-select form-select-sm" name="user_gol_darah">
                                    <option value="" selected>--Pilih--</option>
                                    @foreach ($golongan_darah as $key => $val)
                                        <option value="{{$key}}">{{$val}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if (Auth::user()->user_role == 'superAdmin')
                            <div class="col-md-6">
                                <label class="form-label" for="fuser_role">Role</label>
                                <select id="fuser_role" class="form-select form-select-sm" aria-label=".form-select-sm example" name="user_role">
                                    <option value="">--Pilih--</option>
                                    @foreach ($user_role as $key => $val)
                                      @if ($key != 'superAdmin')
                                        <option value="{{$key}}">{{$val}}</option>
                                      @endif
                                    @endforeach
                                </select>
                            </div>
                            @endif
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
    const datas = @json($data);
    const baseURL = '{{$baseURL}}';

    const add = () => {
        $('#formModal').modal('show');
        $('#formData').attr('action', '{{route('warga.add')}}');
        $('#judulModal').text('Tambah Data');
        $('input[type="text"],input[type="number"],select').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseURL}/updateData/${data.user_id}`);
        $('#judulModal').text('Update Data');
        $('#password').val('');
        $.each(data, (i, val) => {
            $(`#${i}`).val(val)
        })
    }

    const hapus = (id, text) => {
        $('#hapusModal').modal('show');
        $('#textHapus').text(text)
        $('#formHapus').attr('action', `${baseURL}/dellData/${id}`)
    }

    $.each(datas.data, (index, data) =>{
        $(`#kontenGambar${data.user_id}`).on('change', ()=>{
        $(`#formCover${data.user_id}`).submit()
    })
    })

    const filterVal = @json($vFilter);
    if(filterVal){
        $.each(filterVal, (i, val) =>{
            $(`#f${i}`).val(val)
        })
    }
</script>
@endpush