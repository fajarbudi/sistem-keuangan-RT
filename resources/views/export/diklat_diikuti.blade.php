<table class="table table-hover">
    <thead>
        <tr>
            <th align="center" style="font-size: 20px" colspan="6" rowspan="3">
                Daftar Diklat Diikuti
                <br>
                {{$datas['namaPegawai']}}
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
            <th width='250px'>Nama</th>
            <th width='150px'>Metode Pembelajaran</th>
            <th width='100px'>Status</th>
            <th width='110px'>Tanggal Mulai</th>
            <th width='110px'>Tanggal Selesai</th>
        </tr>
    </thead>
    <tbody id="content">
        @foreach ($datas['data'] as $key => $data)
        <tr class='content'>
            <td align="left">{{$key + 1}}</td>
            <td>{{$data->diklat_judul}}</td>
            <td>{{$data->diklat_metode_pembelajaran}}</td>
            <td>{{$data->diklat_status}}</td>
            <td>{{$data->diklat_tgl_mulai}}</td>
            <td>{{$data->diklat_tgl_selesai}}</td>
       </tr>
        @endforeach
    </tbody>
</table>