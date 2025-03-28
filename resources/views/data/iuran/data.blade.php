@extends('layout.layout_with_navbar')

@section('title')
{{$namaPage}}
@endsection


@section('content')
<div class="container-fluid">
    <div class="page-title">
        <div style="display: flex; justify-content: space-between">
            <div>
                <a href="{{route('iuran.detail', $iuran->pertemuan_id)}}" class="btn btn-primary mt-2"><i class="fa fa-arrow-left"></i>Kembali</a>
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
            <div style="display: flex; justify-content: flex-end; padding-right: 5%">
                <p class="text-center">
                    <span style="font-size: 15px; font-weight: 500">Total Uang Iuran</span>
                    <br>
                    <strong style="font-size: 17px;">Rp {{number_format($total_iuran->total ?? 0, 0, ",", ".")}}</strong>
                </p>
            </div>
            <div class="card">
                <div class="table-responsive signal-table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 25px">No</th>
                                <th>Nama</th>
                                <th>Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warga as $index => $val)
                               <tr onclick="upload({{$val}}, {{isset($data_iuran[$val->user_id]) ? $data_iuran[$val->user_id]->iuran_data_nominal : 0}})">
                                 <th scope="row">{{$index + 1}}</th>
                                 <td>
                                    <p> {{$val->user_nama}}</p>
                                    <button class="btn btn-sm blue-steel" onclick="detail({{$val->user_id}}, '{{$val->user_nama}}')">Detail Iuran</button>
                                </td>
                                 <td>Rp {{number_format($data_iuran[$val->user_id]->iuran_data_nominal ?? 0, 0, ",", ".")}}</td>
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
                        <input type="hidden" name="iuran_id" value="{{$iuran_id}}">
                        <input type="hidden" name="iuran_data_nominal" id="iuran_data_nominal">
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="old_nominal" id="old_nominal">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label" for="nominal">Nominal</label>
                                <input class="form-control" id="nominal" type="text" placeholder="Masukkan Nominal..." required="" name="">
                            </div>
                        </div>
                        <div class="mt-3 row gap-2">
                            @foreach ($ref_nominal as $vNom)
                                <button style="min-width: 100px;" type="button" class="btn btn-sm blue-steel col" onclick="bantuanNominal({{$vNom->nominal_nominal}})">Rp {{number_format($vNom->nominal_nominal, 0, ",", ".")}}</button>
                            @endforeach
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
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span id="judulDetail"></span></h5>
                <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-toggle-wrapper">
                   <table class="table table-hover">
                      <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Nominal</th>
                        </tr>
                      </thead>
                      <tbody id="detailContent"></tbody>
                   </table>
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
    const baseUrl = "{{route('iuran.update')}}"
    const iuran = @json($iuran);

    const upload = (data, oldNominal) =>{
        if (iuran.iuran_status == 'selesai') {
            $('#simpanIuran').attr('disabled', true)
        } else {
            $('#simpanIuran').attr('disabled', false)
        }
        $('#judulModal').text(`Data ${data.user_nama}`)
        $('#formData').attr('action', `${baseUrl}`);
        $('#formModal').modal('show');
        $('#nominal').val('')
        $('#user_id').val(data.user_id)
        $('#old_nominal').val(oldNominal)
    }

    const formatRupiah = (nominal) =>{
        return new Intl.NumberFormat("id-ID", {
                       style: "currency",
                       currency: "IDR"
                }).format(nominal);
    }

    let delay = null;
    $('#nominal').on('keyup', (s) =>{
        clearTimeout(delay);
        const nominal = s.target.value * 1000;
        const rupiah = formatRupiah(nominal)

        delay = setTimeout(() => {
            if(isNaN(s.target.value) || s.target.value <= 0){
                $('#nominal').val('')
            }else{
                $('#iuran_data_nominal').val(nominal);
                $('#nominal').val(rupiah)
            }
        }, 500);
    })

    const bantuanNominal = (nominal) =>{
        $('#iuran_data_nominal').val(nominal);
        $('#nominal').val(formatRupiah(nominal))
    }

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

    const bln = @json($arr_bln);
    const detailIuran = @json($detail_iuran);
    const detail = (user_id, nama) =>{
        console.log(detailIuran[user_id] == undefined)
        $('#detailModal').modal('show')
        $('#judulDetail').text(nama)
        $.each(bln, (i,v) =>{
         if(detailIuran[user_id] == undefined){
            $('#detailContent').append(
                `
                 <tr class='content'>
                    <th scope="row">${v}</th>
                    <td>-</td>
                </tr>
                `
            )
         }else{
            $('#detailContent').append(
                `
                 <tr class='content'>
                    <th scope="row">${v}</th>
                    <td>${detailIuran[user_id][i] ? formatRupiah(detailIuran[user_id][i]) : '-' }</td>
                </tr>
                `
            )
         }
        })
    }


    $('#detailModal').on('hidden.bs.modal', function (e) {
        $('.content').each(function () {
            this.remove()
        })

        $('.text').remove()
   })
</script>
@endpush