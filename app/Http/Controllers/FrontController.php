<?php

namespace App\Http\Controllers;

use App\Models\data\pengumuman as DataPengumuman;
use App\Models\data\peraturan as DataPeraturan;
use App\Models\data\sop as DataSop;
use App\Models\data\tentang;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontController extends Controller
{
    public function index()
    {
        $load['namaPage'] = 'Front';

        $getpengumuman = DataPengumuman::where('pengumuman_publikasi', '=', 'Ya')->orderBy('pengumuman_urutan')->get();
        $data_pe_text = $data_pe = [];
        foreach ($getpengumuman as $va) {
            if ($va->pengumuman_tipe == 'Running Text') {
                $data_pe_text[] = $va;
            } elseif ($va->pengumuman_tipe == 'Pengumuman') {
                $data_pe[] = $va;
            }
        }
        $load['pe'] = $data_pe;
        $load['pe_text'] = $data_pe_text;


        $g_per = DataPeraturan::where('peraturan_publikasi', '=', 'Ya')->orderBy('peraturan_urutan')->get();
        $load['g_per'] = $g_per;
        $g_sop = DataSop::where('sop_publikasi', '=', 'Ya')->orderBy('sop_urutan')->get();
        $load['g_sop'] = $g_sop;
        // dd($getpengumuman);
        $g_popup = [];
        $num = $numm = 1111;
        $gpop_peng = DataPengumuman::where('pengumuman_publikasi', '=', 'Ya')->where('pengumuman_popup', '=', 'Ya')->orderBy('pengumuman_urutan')->get();
        foreach ($gpop_peng as $val) {
            $numm = $num++;
            $g_popup[$numm]['judul'] = $val->pengumuman_judul ?? '';
            $g_popup[$numm]['isi'] = $val->pengumuman_isi;
            $g_popup[$numm]['pdf'] = $val->pengumuman_pdf;
            $g_popup[$numm]['gambar'] = $val->pengumuman_gambar;
        }
        $num = 3333;
        $gpop_per = DataPeraturan::where('peraturan_publikasi', '=', 'Ya')->where('peraturan_popup', '=', 'Ya')->orderBy('peraturan_urutan')->get();
        foreach ($gpop_per as $val) {
            $numm = $num++;
            $g_popup[$numm]['judul'] = $val->peraturan_judul;
            $g_popup[$numm]['isi'] = $val->peraturan_isi;
            $g_popup[$numm]['pdf'] = $val->peraturan_pdf;
            $g_popup[$numm]['gambar'] = $val->peraturan_gambar;
        }
        $num = 5555;
        $gpop_sop = DataSop::where('sop_publikasi', '=', 'Ya')->where('sop_popup', '=', 'Ya')->orderBy('sop_urutan')->get();
        foreach ($gpop_sop as $val) {
            $numm = $num++;
            $g_popup[$numm]['judul'] = $val->sop_judul;
            $g_popup[$numm]['isi'] = $val->sop_isi;
            $g_popup[$numm]['pdf'] = $val->sop_pdf;
            $g_popup[$numm]['gambar'] = $val->sop_gambar;
        }
        $num = $numm;
        // print_r($g_popup);
        // die;
        $load['g_popup'] = $g_popup;

        $load['tentang'] = tentang::where('tentang_publikasi', '=', 'Ya')->orderBy('tentang_urutan')->first();

        return view('front/front', $load);
    }
}
