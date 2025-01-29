@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div class="col-6">
            <h4>Data Referensi</h4>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row widget-grid">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
<h4>Daftar Data Referensi</h4>
                </div>
                <div class="table-responsive signal-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th>Nama Data</th>
                                <th>Diupdate</th>
                                <th>Dibuat</th>
                                <th class="text-center">
<button class="btn btn-primary" type="button" onclick="add()">
                                        Tambah
                                    </button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $val)
                            <tr>
                                <th scope="row">{{$index + 1}}</th>
                                <td>{{$val -> data_nama}}</td>
                                <td>{{$val -> created_at}}</td>
                                <td>{{$val -> updated_at}}</td>
                                <td class="d-flex d-row justify-content-center">
<button class="btn btn-primary" type="button" onclick="update({{$val}})">
                                        Update
                                    </button>
                                    <button class="btn btn-secondary" type="button"
                                        onclick='hapus({{$val -> id}}, `{{$val -> data_nama}}`)'>Hapus</button>
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
                <h3 id="judulModal" class="modal-header justify-content-center border-0">Tambah Data</h3>
                <div class="modal-body">
                    <form id="formData" class="row g-3 needs-validation" novalidate="" action="{{url('/addData')}}"
                        method="POST">
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label" for="validationCustom01">Nama Data</label>
                            <input class="form-control" id="validationCustom01" type="text"
                                placeholder="Enter your name" required="" name="data_nama">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        {{-- <div class="col-md-6">
                            <label class="form-label" for="validationCustom02">Last name</label>
                            <input class="form-control" id="validationCustom02" type="text"
                                placeholder="Enter your surname" required="">
                            <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="exampleFormControlInput1">Email
                                    address</label>
                                <input class="form-control" id="exampleFormControlInput1" type="email"
                                    placeholder="cubatheme@gmail.com">
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <button class="btn btn-primary fload-end" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="modal-toggle-wrapper">
                    <h4>Peringatan !!!!</h4>
                    <p class="text-md-center mt-4">Anda Yakin Mau Menghapus Data</p>
                    <p class="text-sm-center" id="textHapus"></p>
                    <form id="formHapus" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit">
                            Hapus
                        </button>
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
const add = () => {
$('#formModal').modal('show');
$('#formData').attr('action', `/addData`);
$('#judulModal').text('Tambah Data');
$('#validationCustom01').val("");
}

const update = (val) =>{
        const data = val

$('#formModal').modal('show');
        $('#formData').attr('action', `/updateData/${val.id}`);
        $('#judulModal').text('Update Data');
        $('#validationCustom01').val(data.data_nama);
        
        }

    const hapus = (id, text) => {

          $('#hapusModal').modal('show');
          $('#textHapus').text(text)
          $('#formHapus').attr('action', `/dellData/${id}`)

    }
</script>
@endpush