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
            <div>
                <a href="{{route('notulensi')}}" class="btn btn-primary mt-2"><i class="fa fa-arrow-left"></i>Kembali</a>
            </div>
            <div >
                <span class="f-30 f-w-400 mt-1">{{$judulPage}}</span>
            </div>
            {{-- <div >
                <div class="mx-2 mt-2">
                    <button class="btn btn-primary" type="button" onclick="filter()"><i class="fa fa-search"></i> Search</button>
                </div>
            </div> --}}
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
                                <th scope="col" style="width: 25px">No</th>
                                <th>Pertemuan</th>
                                <th>Tanggal</th>
                                @if (Auth::user()->can('admin', $user) || Auth::user()->can('sekertaris', $user))                            
                                <th class="text-center"><button class="btn btn-sm btn-danger" type="button" onclick="add()"><i class="icon-pencil-alt"></i> Tambah</button></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $index => $val)
                            @php
                                $hasilDiskusi = explode("\n", trim($val->notulensi_isi));
                            @endphp
                               <tr>
                                 <th scope="row">{{$index + 1}}</th>
                                 <td>{{$val->pertemuan->pertemuan_nama}}</td>
                                 <td>{{fAnaTgl($val->pertemuan->pertemuan_tgl, 'hri, tgl bln thn')}}</td>
                                 @if (Auth::user()->can('admin', $user) || Auth::user()->can('sekertaris', $user))                           
                                 <td align="center">
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                        <button class="btn btn-sm btn-primary" type="button" onclick="update({{$val}})"><i class="fa fa-pencil-square-o"></i> Update</button>
                                        <button class="btn btn-sm btn-secondary" type="button" onclick='hapus({{$val -> notulensi_data_id}}, `{{$val -> notulensi_topik}}`)'><i class="fa fa-times"></i> Hapus</button>
                                    </div>
                                </td>
                                 @endif
                              </tr>
                              <tr>
                                <td colspan="1" style="min-width: 130px;; vertical-align: top"><strong>Hasil Diskusi :</strong></td>
                                <td colspan="11">
                                 @foreach ($hasilDiskusi as $kDiskusi => $vDiskusi)
                                   <span style="width: 20px">{{$kDiskusi + 1}}.</span> <span> </span> <span>{{$vDiskusi}}</span>
                                   <br>
                                 @endforeach
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
                        <input type="hidden" name="notulensi_id" value="{{$notulensi_id}}">
                        <div class="col-12 mb-2">
                            <label class="form-label" for="pertemuan_id">Pertemuan</label>
                            <select id="pertemuan_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name="pertemuan_id">
                                <option value="">--Pilih--</option>
                                @foreach ($pertemuan as $key => $val)
                                   <option value="{{$val->pertemuan_id}}">{{$val->pertemuan_nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="notulensi_isi">Hasil Diskusi</label>
                            <textarea name="notulensi_isi" id="notulensi_isi" class="form-control" rows="12"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col">
                            <button class="btn btn-secondary fload-end" type="button" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-arrow-left"></i> Kembali</button>
                        </div>
                        <div class="col text-end">
                            <button id="simpanIuran" class="btn btn-primary fload-end" type="submit"><i class="fa fa-floppy-o"></i> Simpan </button>
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
    const baseUrl = "{{$baseURL}}"

    const add = () => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/addData`);
        $('#judulModal').text('Tambah Data');
        $('#notulensi_isi').val("");
    }

    const update = (data) => {
        $('#formModal').modal('show');
        $('#formData').attr('action', `${baseUrl}/updateData/${data.notulensi_data_id}`);
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

</script>
@endpush