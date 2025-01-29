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
       </div>
    </div>
</div>

<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
          <div class="col-xl-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title mb-0">My Profile</h4>
                <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
              </div>
              <div class="card-body">
                <form method="POST" action="{{route('user.update', $data->user_id ?? '')}}" enctype="multipart/form-data" id="form_update_profile">
                  @csrf
                    <input type="file" class="d-none" id="kontenGambar" name="user_foto" onchange="$('#form_update_profile').submit()">
                  <div class="row mb-2">
                    <div class="profile-title">
                      <div class="media">
                       <div style="display: flex; flex-direction: column">
                        <img class="img-90 rounded-circle" alt="" src="@if (isset($data->user_foto))
                        {{ url('storage/'. $data->user_foto)}}
                     @else
                         {{asset('/assets/images/dashboard/profile.png')}}
                     @endif">                  
                      <button type="button" style="background-color: rgb(4, 173, 4)" onclick="$('#kontenGambar').trigger('click')" class="btn btn-sm btn-primary mt-2">{{(isset($data->user_foto)) ? 'Update' : 'Upload'}}</button>
                       </div>
                        <div class="media-body">
                          <h5 class="mb-1">{{$data->user_nama ?? $data->user_nama}}</h5>
                          <p>{{(isset($data->ref_jabatan->jabatan_nama)) ? $data->ref_jabatan->jabatan_nama : $data->user_role}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input class="form-control {{!isset($data->user_nama) ? 'border-danger' : ''}}" placeholder="Nama Warga" value="{{$data->user_nama ?? ''}}" {{!isset($data->user_nama) ? 'readonly' : ''}} @if (isset($data->user_nama))
                        name="user_nama"
                    @endif>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input class="form-control {{!isset($data->user_nama) ? 'border-danger' : ''}}" placeholder="Username" value="{{$data->user_username ?? ''}}" {{!isset($data->user_username) ? 'readonly' : ''}} @if (isset($data->user_username))
                        name="user_username"
                    @endif>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" placeholder="your-email@domain.com" value="{{$data->user_email}}" name="user_email">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="text" name="password">
                  </div>
                   <div class="mb-3">
                    <label class="form-label">No Handphone</label>
                    <input class="form-control" placeholder="Nomor Handphone" value="{{$data->user_Telp ?? ''}}" name="user_Telp">
                  </div>
                  <div class="col-md-12">
                    <label class="form-label" for="user_gol_darah">Golongan Darah</label>
                    <select id="user_gol_darah" class="form-select form-select-sm" name="user_gol_darah">
                        <option value="" selected>--Pilih--</option>
                        @foreach ($golongan_darah as $key => $val)
                            <option value="{{$key}}">{{$val}}</option>
                        @endforeach
                    </select>
                </div>
                  <div class="form-footer text-end">
                    <button class="btn btn-primary btn-block mt-3">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

</div>

<script>
  const data = @json($data);
  $('#user_gol_darah').val(data.user_gol_darah)
</script>
@endsection