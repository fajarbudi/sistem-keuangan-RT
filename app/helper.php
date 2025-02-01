<?php

use Carbon\Carbon;

function lang($key, $print = 0)
{
    $lang   = array();
    $lang['app']   = '';
    $lang['app_n']   = 'Website Kepegawaian Serayu Opak';
    $lang['app_l']   = 'Sistem Keuangan';
    $lang['app_z']   = 'YAKEPO BBWS Serayu Opak';
    $lang['powered']   = 'powered by Anauri Indonesia';
    $lang['skpd_s']   = 'BBWS SO';
    $lang['skpd']   = 'Sistem Keuangan RT.09';
    $lang['skpd_l']   = 'Balai Besar Wilayah Sungai Serayu Opak';
    $lang['pemkab']   = 'RT.09 / RW.20 Krapyak Triharjo Sleman';
    $lang['direktorat']   = 'Direktorat Jendral Sumber Daya AIR';
    $lang['kementrian']   = 'Kementrian Pekerjaan Umum Dan Perumahan Rakyat';
    $lang['pemkab_s']   = 'BBWS Serayu Opak';
    $lang['regional']   = 'Kabupaten';
    $lang['jalan']   = 'Jln. Magelang, Anauri Indonesia, Yogyakarta, Indonesia';
    $lang['alamat']   = 'Jl.Magelang Km 12 Yogyakarta 55514;';
    $lang['alamat2']   = 'Telepon (082220915599), Laman disdukcapil.kutaitimurkab.go.id,';
    $lang['alamat3']   = 'Pos-el disdukcapil@kutaitimurkab.go.id';
    $lang['copy']   = 'Copyright &copy; 2024 Anauri Indonesia';
    $lang['email']   = 'info@anauri.go.id';
    $lang['telepon']   = 'Telepon (081) 22772812;';
    $lang['tentang']   = 'Aplikasi YAKEPO (Layanan Kepegawaian Serayu Opak) merupakan aplikasi yang dikembangkan untuk meningkatkan transparansi proses urusan kepegawaian yang dikelola oleh tim kepegawaian BBWS Serayu Opak. Melalui aplikasi ini seluruh pegawai dapat memantau surat/usulan/proses kepegawaian.';
    $lang[8]   = 'Data sukses disimpan';
    $lang[9]   = 'Data Berhasil di Perbarui';
    $lang[10]   = 'Perubahan berhasil disimpan !!!';
    $lang[11]   = 'Perubahan data gagal dilakukan !!!';
    $lang[]   = 'Halaman tidak sah, silahkan menghubungi admin untuk informasi !!!';
    $lang[]   = 'Halaman tidak diperbolehkan !!!';
    $lang[]   = 'Form Harus Diisi, Data tidak lengkap !!!';
    $lang[15]   = 'Data berhasil dihapus';
    $lang[16]   = 'Data gagal dihapus';
    $lang[]   = 'Tidak dapat meyimpan data !';
    $lang[]   = 'Data Sudah Tersedia !!!';
    $lang[]   = '<span class="glyphicon glyphicon-exclamation-sign"></span> Data Tidak Tersedia...';
    $lang[22]   = '<span class="glyphicon glyphicon-exclamation-sign"></span> Data Tidak Lengkap !!!';
    $lang[]   = 'Anggota baru berhasil ditambahkan !';
    $lang[]   = '<span class="glyphicon glyphicon-exclamation-sign"></span> Data Belum Tersedia...';
    $lang[]   = 'Halaman tidak tersedia, silahkan pilih tanggal terlebih dahulu !';
    $lang[]   = 'Tidak Diperbolehkan... !!!';
    $lang['required']   = 'Formulir tidak boleh kosong...';
    $lang['min3']   = 'Formulir harus diisi minimal 3 karakter...';
    if (isset($lang[$key])) {
        if ($print == true) {
            echo $lang[$key];
        } else {
            return $lang[$key];
        }
    }
}

function jenis_pegawai($key = '')
{
    $tdata = array('NIP', 'NIPPPK', 'NRTK2D');
    $result = array_combine($tdata, $tdata);
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function jenis_biaya($key = '')
{
    $result = ['Transportasi' => 'Biaya Transportasi (PP)', 'Lumpsum' => 'Biaya Lumpsum'];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}

function jenis_cuti($key = '')
{
    $result = [
        'Tahunan' => 'Tahunan',
        'Besar' => 'Besar',
        'Sakit' => 'Sakit',
        'Melahirkan' => 'Melahirkan',
        'Karena Alasan Penting' => 'Karena Alasan Penting',
        'Diluar Tanggungan Negara' => 'Diluar Tanggungan Negara',
    ];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function jenis_pengaduan($key = '')
{
    $result = [
        'Kode Etik' => 'Kode Etik',
    ];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function golongan_Darah($key = '')
{
    $result = [
        'A' => 'A',
        'B' => 'B',
        'AB' => 'AB',
        'O' => 'O',
    ];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function jenis_kelamin($key = '')
{
    $result = [
        'L' => 'Laki-Laki',
        'P' => 'Perempuan',
    ];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}

function user_role($key = '')
{
    $result = [
        'superAdmin' => 'Super Admin',
        'ketua' => 'Ketua',
        'bendahara' => 'Bendahara',
        'sekertaris' => 'Sekertaris',
        'warga' => 'Warga'
    ];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function warna($key = '')
{
    $result =  ['blue-steel', 'btn-primary', 'btn-secondary', 'btn-success', 'btn-info', 'btn-warning', 'btn-danger'];
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}

function arr_penandatangan($key = '')
{
    $result = array(
        'Penandatangan' => 'Penandatangan',
        // 'KPA' => 'Kuasa Pengguna Anggaran',
        // 'BPP' => 'Bendahara Pengeluaran',
        // 'PPTK' => 'Pejabat Pelaksana Teknis Kegiatan',
        //'' => '',
    );
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function arr_sebagai_atasan($key = '')
{
    $result = array(
        'Sebagai Atasan' => 'Sebagai Atasan',
        // 'KPA' => 'Kuasa Pengguna Anggaran',
        // 'BPP' => 'Bendahara Pengeluaran',
        // 'PPTK' => 'Pejabat Pelaksana Teknis Kegiatan',
        //'' => '',
    );
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function arr_pegawai_status($key = '')
{
    $result = array(
        'PNS' => 'PNS',
        'PPPK' => 'PPPK',
        'NPN' => 'NPN'
        // 'BPP' => 'Bendahara Pengeluaran',
        // 'PPTK' => 'Pejabat Pelaksana Teknis Kegiatan',
        //'' => '',
    );
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function arr_diklat_status($key = '')
{
    $result = array(
        'Registrasi' => 'Registrasi',
        'Tutup' => 'Tutup Registrasi',
        'Dibatalkan' => 'Dibatalkan',
    );
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function arr_metode_pembelajaran($key = '')
{
    $result = array(
        'Classical' => 'Classical',
        'Elearning' => 'Elearning',
        'Blended' => 'Blended',
    );
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}
function arr_jenis_dokumen($key = '')
{
    $result = array(
        'SPT' => 'SPT',
        'ATK' => 'ATK',
        'KertasCover' => 'KERTAS & COVER',
        'BahanCetak' => 'BAHAN CETAK',
        'BendaPOS' => 'BENDA POS',
        'BahanKomputer' => 'BAHAN KOMPUTER',
        'MakanMinum' => 'MAKAN MINUM RAPAT',
        'BimbinganTeknis' => 'BIMBINGAN TEKNIS',
        'BelanjaModal' => 'BELANJA MODAL',
        'Honoriraum' => 'HONORIRAUM',
        'PerabotKantor' => 'PERABOT KANTOR',
        'TagihanAir' => 'TAGIHAN AIR',
        'TagihanInternet' => 'Tagihan Internet',
        'Pemeliharaan' => 'PEMELIHARAAN',
        'BahanBakar' => 'BAHAN BAKAR',
        'SukuCadang' => 'SUKU CADANG',
        'Pajak' => 'PAJAK',
        'PakaianDinas' => 'PAKAIAN DINAS',
        //'' => '',
    );
    if (isset($key) and $key) {
        if (isset($result[$key])) {
            return $result[$key];
        } else {
            return false;
        }
    } else {
        return $result;
    }
}

function fAnaTgl($date = '', $format = '', $fullmonth = true, $lihathari = true, $lihatjam = true)
{
    if (!$date)
        $date = date('Y-m-d H:i:s');
    $arr_bln   = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
    $arr_bln3   = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");
    if ($fullmonth)
        $arr_bln   = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $arr_hari   = array("", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu", "Minggu");
    if ($date == '0000-00-00') {
        return '';
    } elseif ($date == '0000-00-00 00:00:00') {
        return '';
    } else {
        $date   = trim($date);
        $hari   = intval(date('N', strtotime($date)));
        $date   = str_replace(array(' ', ':'), '-', $date);
        //@list($th, $bl, $tg)	= explode('-', $date);
        @list($th, $bl, $tg, $jam, $min, $sec)   = explode('-', $date);
        $tgl_indo   = '';

        if ($format) {
            $tgl_indo = $format;
            /*$tgl_indo = str_replace('hari', $arr_hari[$hari], $tgl_indo);
            $tgl_indo = str_replace('tahun', $th, $tgl_indo);
            $tgl_indo = str_replace('bulan', $arr_bln[intval($bl)], $tgl_indo);
            $tgl_indo = str_replace('tanggal', $tg, $tgl_indo);
            $tgl_indo = str_replace('jam', $jam, $tgl_indo);
            $tgl_indo = str_replace('menit', $min, $tgl_indo);
            $tgl_indo = str_replace('detik', $sec, $tgl_indo);*/

            $tgl_indo = str_replace('hri', $arr_hari[$hari], $tgl_indo);
            $tgl_indo = str_replace('thn', $th, $tgl_indo);
            $tgl_indo = str_replace('sbln', intval($bl), $tgl_indo);
            $tgl_indo = str_replace('3bln', $arr_bln3[intval($bl)], $tgl_indo);
            $tgl_indo = str_replace('bln', $arr_bln[intval($bl)], $tgl_indo);
            $tgl_indo = str_replace('tgl', $tg, $tgl_indo);
            $tgl_indo = str_replace('jam', $jam, $tgl_indo);
            $tgl_indo = str_replace('mnt', $min, $tgl_indo);
            $tgl_indo = str_replace('dtk', $sec, $tgl_indo);
        } else {
            if ($lihathari == true) {
                $tgl_indo   .= ' ' . $arr_hari[$hari] . ', ';
            }
            $tgl_indo   .= $tg . ' ' . $arr_bln[intval($bl)] . ' ' . $th;
            if ($lihatjam == true and $jam) {
                $tgl_indo .=  ' ' . $jam . ':' . $min;
            }
        }
        return $tgl_indo;
    }
}


function count_masa_kerja($tmt80, $pmulai = '', $pselesai = '')
{
    $result = array();
    $result['bt'] = 0;
    $result['bb'] = 0;
    $a = date_create($tmt80);
    $b = date_create('today');
    $jumlahtahun = $result['at'] = $a->diff($b)->y;
    $jumlahbulan = $result['ab'] = $a->diff($b)->m;
    if ($pmulai and $pselesai) {
        $c = date_create($pmulai);
        $d = date_create($pselesai);
        $jumlahtahun += $result['bt'] = $c->diff($d)->y;
        $jumlahbulan += $result['bb'] = $c->diff($d)->m;
    }
    if ($jumlahbulan > 12) {
        $jumlahtahun += 1;
        $jumlahbulan = $jumlahbulan - 12;
    }
    $result['ct'] = $jumlahtahun;
    $result['cb'] = $jumlahbulan;
    //print_r($result); die();

    return $result;
}

if (!function_exists('anaRp')) {
    function anaRp($value)
    {
        return  number_format($value, 0, ',', '.');
    }
}
if (!function_exists('toRp')) {
    function toRp($value)
    {
        return  'Rp. ' . number_format($value, 2, ',', '.');
    }
}

if (!function_exists('hitungPajak')) {
    function hitungPajak($value)
    {
        $vat = $value * 0.11;
        return  $vat;
    }
}

function hit_hari($from, $to = '')
{
    if (empty($to))
        $to = time();
    $diff = date_diff(date_create($from), date_create($to));
    return $diff->d;
}

function terbilang_get_valid($str, $from, $to, $min = 1, $max = 9)
{
    $val = false;
    $from = ($from < 0) ? 0 : $from;
    for ($i = $from; $i < $to; $i++) {
        if (((int) $str[$i] >= $min) && ((int) $str[$i] <= $max)) $val = true;
    }
    return $val;
}
function terbilang_get_str($i, $str, $len)
{
    $numA = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan");
    $numB = array("", "se", "dua ", "tiga ", "empat ", "lima ", "enam ", "tujuh ", "delapan ", "sembilan ");
    $numC = array("", "satu ", "dua ", "tiga ", "empat ", "lima ", "enam ", "tujuh ", "delapan ", "sembilan ");
    $numD = array(0 => "puluh", 1 => "belas", 2 => "ratus", 4 => "ribu", 7 => "juta", 10 => "milyar", 13 => "triliun");
    $buf = "";
    $pos = $len - $i;
    switch ($pos) {
        case 1:
            if (!terbilang_get_valid($str, $i - 1, $i, 1, 1))
                $buf = $numA[(int) $str[$i]];
            break;
        case 2:
        case 5:
        case 8:
        case 11:
        case 14:
            if ((int) $str[$i] == 1) {
                if ((int) $str[$i + 1] == 0)
                    $buf = ($numB[(int) $str[$i]]) . ($numD[0]);
                else
                    $buf = ($numB[(int) $str[$i + 1]]) . ($numD[1]);
            } else if ((int) $str[$i] > 1) {
                $buf = ($numB[(int) $str[$i]]) . ($numD[0]);
            }
            break;
        case 3:
        case 6:
        case 9:
        case 12:
        case 15:
            if ((int) $str[$i] > 0) {
                $buf = ($numB[(int) $str[$i]]) . ($numD[2]);
            }
            break;
        case 4:
        case 7:
        case 10:
        case 13:
            if (terbilang_get_valid($str, $i - 2, $i)) {
                if (!terbilang_get_valid($str, $i - 1, $i, 1, 1))
                    $buf = $numC[(int) $str[$i]] . ($numD[$pos]);
                else
                    $buf = $numD[$pos];
            } else if ((int) $str[$i] > 0) {
                if ($pos == 4)
                    $buf = ($numB[(int) $str[$i]]) . ($numD[$pos]);
                else
                    $buf = ($numC[(int) $str[$i]]) . ($numD[$pos]);
            }
            break;
    }
    return $buf;
}
function toTerbilang($nominal)
{
    $buf = "";
    $str = $nominal . "";
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $buf = trim($buf) . " " . terbilang_get_str($i, $str, $len);
    }
    return ucwords(trim($buf)) . ' Rupiah';
}
function toBilangan($nominal)
{
    $buf = "";
    $str = $nominal . "";
    $len = strlen($str);
    for ($i = 0; $i < $len; $i++) {
        $buf = trim($buf) . " " . terbilang_get_str($i, $str, $len);
    }
    return ucwords(trim($buf));
}

if (!function_exists('anaCleanChar')) {
    function anaCleanChar($result)
    {
        $result = strip_tags($result);
        $result = str_replace('(', '::kbuka::', $result);
        $result = str_replace(')', '::ktutup::', $result);
        $result = str_replace('/', '::garing::', $result);
        $result = str_replace('-', '::dash::', $result);
        $result = preg_replace('/&.+?;/', ' ', $result);
        $result = str_replace('&', '::and::', $result);
        $result = preg_replace('/\s+/', ' ', $result);
        $result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
        $result = preg_replace('|-+|', ' ', $result);
        $result = preg_replace('/&#?[a-z0-9]+;/i', ' ', $result);
        $result = preg_replace('/[^%A-Za-z0-9,.:% _]/', ' ', $result);
        $result = trim($result, ' ');
        $result = str_replace('::kbuka::', '(', $result);
        $result = str_replace('::ktutup::', ')', $result);
        $result = str_replace('::garing::', '/', $result);
        $result = str_replace('::dash::', '-', $result);
        $result = str_replace('::and::', '&', $result);
        $result = trim($result);
        $result = trim($result, '-');
        $result    = str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), " ", $result);
        $result = trim($result);
        return $result;
    }
}
function anaCleanInt($result)
{
    $result = strip_tags($result);
    $result = preg_replace('/&.+?;/', ' ', $result);
    $result = preg_replace('/\s+/', ' ', $result);
    $result = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', ' ', $result);
    $result = preg_replace('|-+|', ' ', $result);
    $result = preg_replace('/&#?[0-9]+;/i', ' ', $result);
    $result = preg_replace('/[^%0-9]/', ' ', $result);
    $result = trim($result, ' ');
    $result    = str_replace(array("     ", "     ", "    ", "   ", "  ", "--", " "), "", $result);
    return $result;
}
if (!function_exists('to_slug_clean')) {
    function to_slug_clean($title)
    {
        $title            = trim($title);
        $arra            = array("!", "@", "/", ":", "#", "$", "%", "^", "&", "*", "(", ")", " - ", "_", "?", ">", "<", ",", "[", "]", "{", "}");
        $clean_title    = str_replace($arra, " ", $title);
        $arra2            = array("     ", "    ", "   ", "  ", "---", "--", " ");
        $_tolink        = strtolower(str_replace($arra2, " ", trim($clean_title)));
        return $_tolink;
    }
}

function hariKerja($startDate, $endDate)
{
    $mulai = strtotime($startDate);
    $selesai   = strtotime($endDate);
    if ($mulai > $selesai) {

        return 0;
    } else {
        $hari  = 0;
        while ($mulai <= $selesai) {
            $hariKe = date("N", $mulai);
            if (!in_array($hariKe, [6, 7]))
                $hari++;
            $mulai += 86400;
        };

        return $hari;
    }
}
