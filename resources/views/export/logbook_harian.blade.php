<table class="table table-hover">
    <thead>
        <tr>
            <th align="center" style="font-size: 20px" colspan="9">{{$datas['judulPage']}} {{$datas['bulan']}} {{$datas['tahun']}}</th>
        </tr>
        <tr>
            <th scope="col">No</th>
            <th width='250px'>Tanggal</th>
            <th width='350px'>Pegawai</th>
            <th width='250px'>Jenis Kegiatan/Deskripsi</th>
            <th>Durasi</th>
            <th width='450px'>Keterangan</th>
            {{-- <th>Dibuat</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($datas['data'] as $index => $val)
        <tr>
            <th scope="row">{{$index + 1}}</th>
            <td>{{fAnaTgl( $val->logbook_tgl, 'hri, tgl bln thn')}}</td>
            <td>
               Nama : {{$val->pegawai->pegawai_nama ?? ''}}
                <br>
               Jabatan : {{$val->pegawai->ref_jabatan->jabatan_nama ?? ''}}
            </td>
            <td>
                <em>{{$val->ref_kegiatan->ref_jenis_kegiatan->jenis_kegiatan_nama ?? ''}}</em>: {{$val->ref_kegiatan->kegiatan_nama ?? ''}}
                <br>
                {{$val->logbook_judul}}
            </td>
            <td>
                {{$val->logbook_durasi}} Menit
            </td>
            <td>{{$val->logbook_isi}}</td>
            {{-- <td>
                On - {{fAnaTgl($val->created_at, 'jam:mnt - hri, tgl bln thn')}}
            <br>
                Up - {{fAnaTgl($val->updated_at, 'jam:mnt - hri, tgl bln thn')}}
            </td> --}}
        </tr>
        @endforeach
    </tbody>
</table>