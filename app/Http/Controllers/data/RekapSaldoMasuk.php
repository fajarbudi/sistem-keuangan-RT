<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\saldo;
use App\Models\referensi\ref_jenis_saldo_masuk;
use App\Models\referensi\ref_jenis_uang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapSaldoMasuk extends Controller
{
    public function dataView(Request $request)
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'RekapUangMasuk';
        $load['judulPage'] = 'Rekapitulasi Uang Masuk';
        $load['baseURL'] = route('rekap_saldo_masuk');
        $tahun = ($request->tahun) ? $request->tahun : date('Y');
        $bulan = ($request->bulan) ? $request->bulan : date('n');
        $filter = [];

        $arr_bln   = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "Mei", 6 => "Jun", 7 => "Jul", 8 => "Agu", 9 => "Sep", 10 => "Okt", 11 => "Nov", 12 => "Des");
        $query = saldo::select('*');
        if ($request->all()) {
            foreach ($request->all() as $key => $val) {
                if ($val && $key != 'page') {
                    $filter[$key] = $val;
                }
            }

            foreach ($filter as $key => $val) {
                if ($key != 'tahun' && $key != 'bulan') {
                    $query->where($key, 'like', '%' . $val . '%');
                }
            }
        }
        $query->where('saldo_kategori', $userLogin->user_jenis_kelamin);
        $query->where('saldo_status', '=', 'masuk');
        $query->whereMonth('saldo_tgl', $bulan);
        $query->whereYear('saldo_tgl', $tahun);
        $query->leftJoin('ref_jenis_uangs', 'saldos.saldo_jenis', '=', 'ref_jenis_uangs.jenis_uang_id');
        $query->leftJoin('ref_jenis_iurans', 'saldos.jenis_iuran_id', '=', 'ref_jenis_iurans.jenis_iuran_id');
        $datas = $query->orderBy('saldos.created_at', 'DESC')->get();


        for ($i = 5; $i >= 0; $i--) {
            $load['arr_tahun'][] = date('Y', strtotime("-$i year"));
        }

        $jumlah = 0;
        foreach ($datas as $dVal) {
            $jumlah += $dVal->saldo_nominal;
        }

        $load['data'] = $datas;
        $load['filterVal'] = $filter;
        $load['jenis_saldo_masuk'] = ref_jenis_saldo_masuk::get();
        $load['tahun'] = $tahun;
        $load['bulan'] = $arr_bln[$bulan];
        $load['arr_bulan'] = $arr_bln;
        $load['total_saldo_masuk'] = $jumlah;
        $load['jenis_uang'] = ref_jenis_uang::where('jenis_uang_kategori', $userLogin->user_jenis_kelamin)->get();

        return view('data.rekapitulasi_saldo_masuk', $load);
    }
}
