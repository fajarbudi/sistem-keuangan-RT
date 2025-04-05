<div style="border: 3px solid cornflowerblue; padding: 20px">
    <table>
        <tbody>
            <tr style="line-height: 10px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12" align="center" style="font-size: 30px; font-weight: bold">BERITA LELAYU</td>
            </tr>

            <tr style="line-height: 40px;">
                <td colspan="12"></td>
            </tr>

            <tr>
                <td colspan="12"> Kepada Yth.</td>
            </tr>
            <tr>
                <td colspan="12"> Bapak/Ibu/Sdr/Sdri…………………</td>
            </tr>
            <tr>
                <td colspan="12"> Di ……………………………………</td>
            </tr>

            <tr style="line-height: 50px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12" align="center" style="font-size: 16px">Assalaamu'alaikum wa rahmatullahi wa
                    barakaatuh
                </td>
            </tr>
            <tr style="line-height: 5px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12" align="center" style="font-size: 25px">INNALILLAHI WA INNA ILAIHI ROJIUN
                </td>
            </tr>
            <tr style="line-height: 25px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12" align="center" style="font-size: 13.2px">Telah meninggal dunia dengan tenang :
                </td>
            </tr>
            <tr style="line-height: 20px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12" align="center" style="font-size: 25px; font-weight: bold">
                    <u>
                        <span>{{ $data->berita_lelayu_jenis_kelamin == 'L' ? 'Alm' : 'Almh' }}.
                        </span>{{ $data->berita_lelayu_nama }}
                    </u>
                </td>
            </tr>
            <tr>
                <td colspan="12" align="center" style="font-size: 15px; font-weight: 800">
                    <span>Umur </span>{{ $data->berita_lelayu_umur }} Tahun
                </td>
            </tr>

            <tr style="line-height: 35px;">
                <td colspan="12"></td>
            </tr>

            <tr>
                <td colspan="12"> Meninggal dunia pada :</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Hari</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ fAnaTgl($data->berita_lelayu_tgl, 'hri') }}</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Tanggal</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ fAnaTgl($data->berita_lelayu_tgl, 'tgl bln thn') }}</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Pukul</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ $data->berita_lelayu_jam }} WIB</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Alamat</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ $data->berita_lelayu_alamat }}</td>
            </tr>

            <tr style="line-height: 15px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"> Jenazah akan dimakamkan pada :</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Hari</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ fAnaTgl($data->berita_lelayu_dimakamkan, 'hri') }}</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Tanggal</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ fAnaTgl($data->berita_lelayu_dimakamkan, 'tgl bln thn') }}</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Pukul</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ $data->berita_lelayu_dimakamkan_jam }} WIB</td>
            </tr>
            <tr>
                <td style="width: 30px"></td>
                <td colspan="2">Di</td>
                <td style="width: 10px">:</td>
                <td align="left" colspan="8">{{ $data->berita_lelayu_dimakamkan_tempat }}</td>
            </tr>

            <tr style="line-height: 40px;">
                <td colspan="12"></td>
            </tr>

            <tr>
                <td colspan="12"> Demikian berita lelayu ini kami sampaikan, mohon agar dapat disebarluaskan kepada
                    sanak saudara</td>
            </tr>
            <tr>
                <td colspan="12"> dan handai taulan. Atas perhatiannya kami ucapkan terimakasih.</td>
            </tr>

            <tr style="line-height: 35px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td style="width: 50px"></td>
                <td colspan="11" align="center" style="font-size: 16px">wa'alaikumsalam warrahmatullahi wabarakatuh
                </td>
            </tr>

            <tr style="line-height: 35px;">
                <td colspan="12"></td>
            </tr>
            <tr>
                <td colspan="12"> Kami yang berduka cita :</td>
            </tr>
            <tr style="line-height: 10px;">
                <td colspan="12"></td>
            </tr>
            @php
                $keluargas = explode("\n", trim($data->berita_lelayu_keluarga));
                $kosong = 15 - count($keluargas);
            @endphp

            @foreach ($keluargas as $i => $keluarga)
                @php
                    $text = explode(';', $keluarga);
                @endphp
                <tr style="line-height: 20px">
                    <td></td>
                    <td style="width: 25px">{{ $i + 1 }}.</td>
                    <td colspan="8">{{ $text[0] ?? '' }}</td>
                    <td colspan="2">{{ $text[1] ?? '' }}</td>
                </tr>
            @endforeach

            {{-- Isi kolom Kosong --}}
            @for ($i = 0; $i < $kosong; $i++)
                <tr style="line-height: 20px;">
                    <td colspan="12"></td>
                </tr>
            @endfor

        </tbody>
    </table>
</div>
