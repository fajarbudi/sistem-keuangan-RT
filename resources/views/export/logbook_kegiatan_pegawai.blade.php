<table class="table table-hover">
    <thead>
        <tr>
            <th align="center" style="font-size: 20px" colspan="{{count($datas['kegiatan']) + 4}}">{{$datas['judulPage']}} {{$datas['bulan']}} {{$datas['tahun']}}</th>
        </tr>
        <tr>
            <th rowspan="2" style="vertical-align: middle">No</th>
            <th rowspan="2" style="vertical-align: middle" width='250px'>Nama / NIP</th>
            <th rowspan="2" style="vertical-align: middle" width='350px'>Jabatan</th>
            <th colspan="{{count($datas['kegiatan'])}}" align="center">Kegiatan ( Menit )</th>
            <th rowspan="2" style="vertical-align: middle;" align="center">Total</th>
        </tr>
        <tr>
            @foreach ($datas['kegiatan'] as $kV)
                <th align="center" width='150px'>{{$kV->kegiatan_nama}}</th>
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
            @foreach ($datas['kegiatan'] as $vv)
            @php   
                $tlis = 0;
                if(isset($rekapitulasi[$val->pegawai_id][$vv->kegiatan_id])){
                    $tlis = $rekapitulasi[$val->pegawai_id][$vv->kegiatan_id];
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