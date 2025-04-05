@extends('layout.layout_with_navbar')

@section('title')
    {{ $namaPage }}
@endsection

@php
    $user = App\Models\User::class;
@endphp


@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div style="display: flex; justify-content: space-between">
                <div>
                    <span class="f-30 f-w-400"><i class="icon-layers"></i> {{ $judulPage }}</span>
                </div>
                <div>
                    <div class="mx-2 mt-2">
                        <button class="btn btn-primary" type="button" onclick="filter()"><i class="fa fa-search"></i>
                            Search</button>
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
                                    <th>Dimakamkan</th>
                                    @if (Auth::user()->can('admin', $user) || Auth::user()->can('sekertaris', $user))
                                        <th class="text-center">
                                            <button class="btn btn-sm btn-danger" type="button" onclick="add()"><i
                                                    class="icon-pencil-alt"></i> Tambah</button>
                                        </th>
                                    @endif
                                    @if (Auth::user()->can('warga', $user) || Auth::user()->can('bendahara', $user))
                                        <th class="text-center">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $index => $val)
                                    <tr>
                                        <th scope="row">{{ $index + 1 }}</th>
                                        <td>{{ $val->berita_lelayu_nama }}</td>
                                        <td>
                                            {{ fAnaTgl($val->berita_lelayu_tgl, 'hri, tgl bln thn') }}
                                            <br>
                                            {{ $val->berita_lelayu_jam }} WIB
                                        </td>
                                        <td>
                                            {{ fAnaTgl($val->berita_lelayu_dimakamkan_tgl, 'hri, tgl bln thn') }}
                                            <br>
                                            {{ $val->berita_lelayu_dimakamkan_jam }} WIB
                                        </td>
                                        <td align="center">
                                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                                @if (Auth::user()->can('admin', $user) || Auth::user()->can('sekertaris', $user))
                                                    <button class="btn btn-sm btn-primary" type="button"
                                                        onclick="update({{ $val }})"><i
                                                            class="fa fa-pencil-square-o"></i> Update</button>
                                                    <button class="btn btn-sm btn-secondary" type="button"
                                                        onclick='hapus({{ $val->notulensi_id }}, `{{ $val->notulensi_topik }}`)'><i
                                                            class="fa fa-times"></i> Hapus</button>
                                                @endif
                                             <button type="button" class="btn btn-success btn-sm" onclick="PDFShow('{{ route('berita_lelayu.berita', ['id'=>$val->berita_lelayu_id])}}')"><i class="icofont icofont-read-book me-1"></i>Berita Lelayu</button>
                                             <button type="button" class="btn blue-steel btn-sm" onclick="PDFShow('{{ route('berita_lelayu.banner', ['id'=>$val->berita_lelayu_id])}}')"><i class="icofont icofont-read-book me-1"></i>Cetak Nama</button>
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-toggle-wrapper text-start dark-sign-up">
                    <form id="formData" class=" needs-validation" novalidate="" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span
                                    id="judulModal">Tambah Data</span></h5>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_nama">Nama</label>
                                    <input class="form-control" id="berita_lelayu_nama" type="text"
                                        placeholder="Masukkan Nama berita_lelayu..." required=""
                                        name="berita_lelayu_nama">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_jenis_kelamin">Jenis Kelamin</label>
                                    <select id="berita_lelayu_jenis_kelamin" class="form-select form-select-sm"
                                        name="berita_lelayu_jenis_kelamin">
                                        <option value="" selected>--Pilih--</option>
                                        <option value="L">Laki - Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_umur">Umur</label>
                                    <input class="form-control" id="berita_lelayu_umur" type="text"
                                        placeholder="Masukkan Umur..." required="" name="berita_lelayu_umur">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_alamat">Alamat</label>
                                    <input class="form-control" id="berita_lelayu_alamat" type="text"
                                        placeholder="Masukkan Alamat..." required="" name="berita_lelayu_alamat">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_tgl">Tanggal Meninggal</label>
                                    <input class="form-control digits" id="berita_lelayu_tgl" type="date"
                                        data-date-format="YYYY-mm-dd" required="" name="berita_lelayu_tgl">
                                    <div class="invalid-feedback">Isian tidak sesuai...</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_jam">Jam Meninggal</label>
                                    <input class="form-control digits" id="berita_lelayu_jam" type="time" required
                                        name="berita_lelayu_jam">
                                    <div class="invalid-feedback">Isian tidak sesuai...</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_dimakamkan">Tanggal Dimakamkan</label>
                                    <input class="form-control digits" id="berita_lelayu_dimakamkan" type="date"
                                        data-date-format="YYYY-mm-dd" required="" name="berita_lelayu_dimakamkan">
                                    <div class="invalid-feedback">Isian tidak sesuai...</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_dimakamkan_jam">Jam Dimakamkan</label>
                                    <input class="form-control digits" id="berita_lelayu_dimakamkan_jam" type="time"
                                        required name="berita_lelayu_dimakamkan_jam">
                                    <div class="invalid-feedback">Isian tidak sesuai...</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label" for="berita_lelayu_dimakamkan_tempat">Tempat
                                        Dimakamkan</label>
                                    <input class="form-control" id="berita_lelayu_dimakamkan_tempat" type="text"
                                        placeholder="Masukkan jam..." required=""
                                        name="berita_lelayu_dimakamkan_tempat">
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="berita_lelayu_keluarga">Daftar Keluarga  <strong style="margin-left: 5px">Pisahkan Nama dan Keterangan dengan Titik koma ( ; )</strong> </label>
                                    <textarea name="berita_lelayu_keluarga" id="berita_lelayu_keluarga" class="form-control" rows="12"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col">
                                <button class="btn btn-secondary fload-end" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"><i class="fa fa-arrow-left"></i> Kembali</button>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-primary fload-end" type="submit"><i class="fa fa-floppy-o"></i>
                                    Simpan </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img src="{{ asset('assets/images/gif/danger.gif') }}" alt="error"></li>
                        </ul>
                        <h4 class="text-center pb-2">Peringatan !!!</h4>
                        <p class="text-center">Konfirmasi penghapusan data ?</p>
                        <p class="text-lg-center" id="textHapus"></p>
                        <form id="formHapus" method="POST">
                            @csrf
                            <button class="btn btn-danger d-flex m-auto" type="submit"><i
                                    class="fa fa-times-circle mt-1 me-1"></i> Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Filter --}}
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-toggle-wrapper text-start dark-sign-up">
                    <form id="formFilter" class=" needs-validation" novalidate="" method="GET">
                        <input type="hidden" name="action" id="action">
                        <div class="modal-header">
                            <h5 class="modal-title" id=""><i class="icon-pencil-alt"></i> <span
                                    id="judulModal">Filter Data</span></h5>
                            <button class="btn-close py-0" type="button" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="fberita_lelayu_nama">Nama</label>
                                    <input class="form-control" id="fberita_lelayu_nama" type="text"
                                        placeholder="Masukkan Nama berita_lelayu..." name="berita_lelayu_nama">
                                </div>
                                {{-- <div class="col-md-6">
                                <label class="form-label" for="fjenis_iuran_id">Jenis berita_lelayu</label>
                                <select id="fjenis_iuran_id" class="form-select form-select-sm" aria-label=".form-select-sm example" name="jenis_iuran_id">
                                    <option value="">--Pilih--</option>
                                    @foreach ($jenis_iuran as $val)
                                    <option value="{{$val->jenis_iuran_id}}">{{$val->jenis_iuran_nama}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col">
                                <a class="btn btn-secondary fload-end" href="{{ $baseURL }}"><i
                                        class="fa fa-rotate-left me-1"></i></i>Reset</a>
                            </div>
                            <div class="col text-end">
                                <button class="btn btn-primary fload-end" type="submit"><i class="fa fa-search"></i>
                                    Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="PDFShowModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <h4 class="text-center" id="text">Data Tidak Tersedia!!!</h4>
                        <iframe id="pdfShow" frameborder="0" height="800px" width="100%" ></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

@push('jsTambahan')
    <script>
        const baseUrl = "{{ $baseURL }}"

        const add = () => {
            $('#formModal').modal('show');
            $('#formData').attr('action', `${baseUrl}/addData`);
            $('#judulModal').text('Tambah Data');
            $('#berita_lelayu_nama').val("");
        }

        const update = (data) => {
            $('#formModal').modal('show');
            $('#formData').attr('action', `${baseUrl}/updateData/${data.berita_lelayu_id}`);
            $('#judulModal').text('Update Data');
            $.each(data, (i, val) => {
                $(`#${i}`).val(val)
            })
        }

        const hapus = (id, text) => {
            $('#hapusModal').modal('show');
            $('#textHapus').text(text)
            $('#formHapus').attr('action', `${baseUrl}/dellData/${id}`)
        }

        const filter = () => {
            $('#action').val('')
            $('#searchModal').modal('show')
        }

        const download = () => {
            $('#action').val('download')
            $('#formFilter').submit()
        }

        const filterVal = @json($filterVal);
        if (filterVal) {
            $.each(filterVal, (key, value) => {
                $(`#f${key}`).val(value)
            })
        }

        const PDFShow = (url) =>{
        $('#PDFShowModal').modal('show')
        if(url){
            $('#text').addClass('d-none')
            $('#pdfShow').removeClass('d-none')
            $('#pdfShow').attr('src', `${url}`)
        }else{
            $('#pdfShow').addClass('d-none')
            $('#text').removeClass('d-none')
        }
    }
    </script>
@endpush
