@php
$tahun = $datas['tahun'];
$bulanAngka = $datas['bulanAngka'];
@endphp

<table class="table table-hover">
    <thead>
        <tr>
            <th align="center" style="font-size: 20px" colspan="{{count($datas['kegiatan']) + 5}}">{{$datas['judulPage']}} {{$datas['bulan']}} {{$tahun}}</th>
        </tr>
        <tr>
            <th rowspan="2" style="vertical-align: middle">Hari</th>
            <th rowspan="2" style="vertical-align: middle" width='100px'>Tanggal</th>
            <th rowspan="2" style="vertical-align: middle" width='250px'>Nama / NIP</th>
            <th rowspan="2" style="vertical-align: middle" width='350px'>Jabatan</th>
            <th colspan="{{count($datas['kegiatan'])}}" align="center">Kegiatan ( Menit )</th>
            <th rowspan="2" style="vertical-align: middle;" class="text-center">Total</th>
        </tr>
        <tr>
            @foreach ($datas['kegiatan'] as $kV)
                <th width='150px'>{{$kV->kegiatan_nama}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($datas['data'] as $index => $val)
        @for ($i = 1; $i <= $datas['jumlahHari']; $i++)
        <tr>
            <th>{{fAnaTgl("$tahun-$bulanAngka-$i", 'hri')}}</th>
            <th scope="row">{{$i < 10 ? 0 : ''}}{{$i}}-{{$datas['bulanAngka']}}-{{$datas['tahun']}}</th>
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
                if(isset($rekapitulasi[$val->pegawai_id][$vv->kegiatan_id][$i])){
                    $tlis = $rekapitulasi[$val->pegawai_id][$vv->kegiatan_id][$i];
                    $jum += $tlis;
                    $tlis = number_format($tlis, 0, ',', '.');
                }
            @endphp
               <td align="right">{{$tlis}}</td>
            @endforeach
            <td align="right">{{$jum}} Menit</td>
        </tr>
        @endfor
        @endforeach
    </tbody>
</table>