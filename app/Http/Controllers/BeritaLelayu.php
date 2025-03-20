<?php

namespace App\Http\Controllers;

use App\Models\data\berita_lelayu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeritaLelayu extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'Berita Lelayu';
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
        $query->whereYear('berita_lelayu_tgl', $tahun);
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
}
