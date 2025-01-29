<table class="table table-hover">
    <thead>
        <tr>
            <th align="center" style="font-size: 20px" colspan="5" rowspan="3">
                Daftar Peserta Diklat
                <br>
                {{$datas['namaDiklat']}}
            </th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
            <th></th>
        </tr>
        <tr>
        <th>No.</th>
        <th width='250px'>Nama/NIP</th>
        <th width='350px'>Jabatan</th>
        <th>Golongan</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody id="content">
        @foreach ($datas['data'] as $key => $data)
        <tr>                                
            <td align="left">{{$key + 1}}</td>
            <td>
                <strong>{{$data->pegawai_nama}}</strong>
                <br>
                {{$data->pegawai_nip}}
            </td>
            <td>{{$data->diklat_pegawai_jabatan}}</td>
            <td>{{$data->diklat_pegawai_golongan}}</td>
            <td>{{$data->pegawai_status}}</td>
        </tr>
        @endforeach
    </tbody>
</table>