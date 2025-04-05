<div style="border: 5px solid cornflowerblue">
    <table>
        <tbody>
            <tr style="line-height: 225px">
                <td colspan="6"></td>
            </tr>
            <tr style="font-size: 70px; font-weight: bold">
                <td align="center" colspan="6">
                    <span>{{ $data->berita_lelayu_jenis_kelamin == 'L' ? 'Alm' : 'Almh' }}.</span>
                    <span>{{ $data->berita_lelayu_jenis_kelamin == 'L' ? 'Bapak' : 'Ibu' }}</span>
                </td>
            </tr>
            <tr style="font-size: 70px; font-weight: bold">
                <td align="center" colspan="6"><u>{{ $data->berita_lelayu_nama }}</u></td>
            </tr>
            <tr style="line-height: 225px">
                <td colspan="6"></td>
            </tr>
        </tbody>
    </table>
</div>
