<table class="table table-hover">
    <thead>
        <tr>
            <th align="center" style="font-size: 20px" colspan="16">{{$datas['judulPage']}} {{$datas['tahun']}}</th>
        </tr>
        <tr>
            <th rowspan="2" style="vertical-align: middle">No</th>
            <th rowspan="2" style="vertical-align: middle" width='250px'>Nama / NIP</th>
            <th rowspan="2" style="vertical-align: middle" width='350px'>Jabatan</th>
            <th colspan="12" align="center">Bulan ( Menit )</th>
            <th rowspan="2" style="vertical-align: middle;" align="center">Total</th>
        </tr>
        <tr>
            @foreach ($datas['arr_bulan'] as $bV)
                <th align="center">{{$bV}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($datas['data'] as $index => $val)
        <tr>
            <th scope="row" align="left">{{$index + 1}}</th>
            <td>
                <strong>{{$val->pegawai_nama}}</strong>
                <br>
                <em>{{$val->pegawai_nip}}</em>
            </td>
            <td>{{$val->ref_jabatan->jabatan_nama ?? ''}}</td>

            @php
                $jum = 0;
            @endphp
            @foreach ($datas['arr_bulan'] as $kk => $vv)
            @php   
                $tlis = 0;
                if(isset($datas['rekapitulasi'][$val->pegawai_id][$kk])){
                    $tlis = $datas['rekapitulasi'][$val->pegawai_id][$kk];
                    $jum += $tlis;
                    $tlis = number_format($tlis, 0, ',', '.');
                }
            @endphp
               <td align="right">{{$tlis}}</td>
            @endforeach
            <td align="right">{{$jum}} Menit</td>
        </tr>
        @endforeach
    </tbody>
</table>