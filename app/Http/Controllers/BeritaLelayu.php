<?php

namespace App\Http\Controllers;

use App\Models\data\berita_lelayu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use TCPDF;

class BeritaLelayu extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'BeritaLelayu';
        $load['judulPage'] = 'Data Berita Lelayu';
        $load['baseURL'] = url('/data/berita_lelayu');
        $tahun = ($request->tahun) ? $request->tahun : date('Y');
        $bulan = ($request->bulan) ? $request->bulan : "";
        $filter = [];

        $arr_bln   = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "Mei", 6 => "Jun", 7 => "Jul", 8 => "Agu", 9 => "Sep", 10 => "Okt", 11 => "Nov", 12 => "Des");
        $query = berita_lelayu::select('*');
        if ($request->bulan) {
            $query->whereMonth('berita_lelayu_tgl', $bulan);
        }
        // $query->whereYear('berita_lelayu_tgl', $tahun);
        $datas = $query->latest()->get();

        if ($request->all()) {
            foreach ($request->all() as $key => $val) {
                if ($val && $key != 'page') {
                    $filter[$key] = $val;
                }
            }
        }

        for ($i = 5; $i >= 0; $i--) {
            $load['arr_tahun'][] = date('Y', strtotime("-$i year"));
        }

        $load['data'] = $datas;
        $load['filterVal'] = $filter;
        $load['tahun'] = $tahun;
        $load['bulan'] = $arr_bln[$bulan] ?? '';
        $load['arr_bulan'] = $arr_bln;

        return view('data.berita_lelayu.berita_lelayu', $load);
    }

    public function addRefData(Request $request)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'berita_lelayu_nama' => ['required', 'string'],
            'berita_lelayu_tgl' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {

            berita_lelayu::create($post);

            return back()->with('Berhasil', 'Data Berhasil Ditambahkan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function updateRefData(Request $request, $id)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'berita_lelayu_nama' => ['required', 'string'],
            'berita_lelayu_tgl' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = berita_lelayu::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = berita_lelayu::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }

    public function c_berita(Request $request, $id = '')
    {
        $load['namaPage'] = 'Berita Lelayu';
        $load['judulPage'] = 'Berita Lelayu';
        $data = berita_lelayu::find($id);
        $load['tanggal'] = Date('Y-m-d', time());


        $load['data'] = $data;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(lang('app'));
        $pdf->SetAuthor(lang('app_z') . ' - Powered by Anauri Indonesia');
        $pdf->SetTitle(lang('app_z') . ' - Powered by Anauri Indonesia');
        //$pdf->SetSubject('Dokumen Kenaikan Berkala a.n. '.trim($gd['gelar_depan'] .' '. $gd['nama'] .' '. $gd['gelar_belakang']).' - SIPACAK - OKUSelatan');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // $pdf->SetMargins(10, 15, 10, true);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $font = 10.5;
        $pdf->SetFont('helvetica', '', $font);

        $pdf->AddPage('P', 'F4');

        $thedata =  \View::make('data.berita_lelayu.c_berita_lelayu', $load)->render();
        // $pdf->SetMargins(0, 0, 0);
        // $pdf->SetHeaderMargin(100);
        // $pdf->SetFooterMargin(100);
        $pdf->writeHTML($thedata, true, false, false, false, '');

        $waktuini = date('Y-m-d-H-i');
        $filename = 'berita-lelayu-' . $data->berita_lelayu_nama . '-' . $waktuini . '.pdf';
        $path = 'dokumen/berita_lelayu/' . $data->berita_lelayu_nama . '/created';
        $dirPath = Storage::disk('public')->makeDirectory($path);
        $filePath = Storage::disk('public')->path($path . '/' . $filename);

        ob_end_clean();
        $pdf->Output($filePath, 'I');

        // $pdf = PDF::loadView('dokumen.spt.cetak.c_spt', $load)->setPaper('a4', 'landscape');
        // return PDF::stream();

        //return view('dokumen.spt.cetak.c_spt', $load);
    }

    public function c_banner(Request $request, $id = '')
    {
        $load['namaPage'] = 'Berita Lelayu';
        $load['judulPage'] = 'Berita Lelayu';
        $data = berita_lelayu::find($id);
        $load['tanggal'] = Date('Y-m-d', time());


        $load['data'] = $data;

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(lang('app'));
        $pdf->SetAuthor(lang('app_z') . ' - Powered by Anauri Indonesia');
        $pdf->SetTitle(lang('app_z') . ' - Powered by Anauri Indonesia');
        //$pdf->SetSubject('Dokumen Kenaikan Berkala a.n. '.trim($gd['gelar_depan'] .' '. $gd['nama'] .' '. $gd['gelar_belakang']).' - SIPACAK - OKUSelatan');

        // set default header data
        //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 048', PDF_HEADER_STRING);

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        // $pdf->SetMargins(10, 15, 10, true);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $font = 10.5;
        $pdf->SetFont('helvetica', '', $font);

        $pdf->AddPage('L', 'F4');

        $thedata =  \View::make('data.berita_lelayu.c_banner_lelayu', $load)->render();
        // $pdf->SetMargins(0, 0, 0);
        // $pdf->SetHeaderMargin(100);
        // $pdf->SetFooterMargin(100);
        $pdf->writeHTML($thedata, true, false, false, false, '');

        $waktuini = date('Y-m-d-H-i');
        $filename = 'berita-lelayu-' . $data->berita_lelayu_nama . '-' . $waktuini . '.pdf';
        $path = 'dokumen/berita_lelayu/' . $data->berita_lelayu_nama . '/created';
        $dirPath = Storage::disk('public')->makeDirectory($path);
        $filePath = Storage::disk('public')->path($path . '/' . $filename);

        ob_end_clean();
        $pdf->Output($filePath, 'I');

        // $pdf = PDF::loadView('dokumen.spt.cetak.c_spt', $load)->setPaper('a4', 'landscape');
        // return PDF::stream();

        //return view('dokumen.spt.cetak.c_spt', $load);
    }
}
