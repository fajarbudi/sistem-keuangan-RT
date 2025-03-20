<?php

namespace App\Http\Controllers;

use App\Models\data\saldo;
use App\Models\data\saldo_sisa;
use App\Models\referensi\ref_jenis_uang;
use App\Models\referensi\ref_jenis_iuran;
use App\Models\referensi\ref_nominal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'Dashboard';
        $arr_bln   = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "Mei", 6 => "Jun", 7 => "Jul", 8 => "Agu", 9 => "Sep", 10 => "Okt", 11 => "Nov", 12 => "Des");
        $bulan = date('n');
        $tahun = date('Y');

        $datas = saldo::select(DB::raw("saldo_status, SUM(saldo_nominal) as jumlah, MONTH(saldo_tgl) as bulan"))
            ->whereYear('saldo_tgl', $tahun)
            ->where('saldo_kategori', $userLogin->user_jenis_kelamin)
            ->groupBy(DB::raw('saldo_status, bulan'))->get();

        $masukPerbulan = [];
        $keluarPerbulan = [];
        foreach ($arr_bln as $kB => $vB) {
            foreach ($datas as $val) {
                if ($val->saldo_status == 'masuk') {
                    if ($val->bulan == $kB) {
                        $masukPerbulan[$kB] = $val->jumlah;
                    }
                }

                if ($val->saldo_status == 'keluar') {
                    if ($val->bulan == $kB) {
                        $keluarPerbulan[$kB] = $val->jumlah;
                    }
                }
            }
        }

        $total = saldo::select(DB::raw(" saldo_status, SUM(saldo_nominal) as jumlah"))
            ->whereMonth('saldo_tgl', $bulan)
            ->whereYear('saldo_tgl', $tahun)
            ->where('saldo_kategori', $userLogin->user_jenis_kelamin)
            ->groupBy(DB::raw('saldo_status'))->get();

        foreach ($total as $tVal) {
            $load["saldo_$tVal->saldo_status"] = $tVal->jumlah;
        }

        $datas2 = saldo::select(DB::raw("saldo_status, SUM(saldo_nominal) as jumlah, jenis_uang_nama, jenis_iuran_nama"))
        ->whereYear('saldo_tgl', $tahun)
            ->where('saldo_kategori', $userLogin->user_jenis_kelamin)
            ->leftJoin('ref_jenis_uangs', 'saldos.saldo_jenis', '=', 'ref_jenis_uangs.jenis_uang_id')
            ->leftJoin('ref_jenis_iurans', 'saldos.jenis_iuran_id', '=', 'ref_jenis_iurans.jenis_iuran_id')
            ->groupBy(DB::raw('saldo_status, jenis_uang_nama, jenis_iuran_nama'))->get();

        // $datas2 = saldo::select(DB::raw("saldo_status, SUM(saldo_nominal) as jumlah, saldo_jenis, jenis_iuran_id"))
        // ->whereYear('saldo_tgl', $tahun)
        //     ->where('saldo_kategori', $userLogin->user_jenis_kelamin)
        //     ->groupBy(DB::raw('saldo_status, saldo_jenis, jenis_iuran_id'))->get();

        // $post = [];
        // $post2 = [];
        // foreach ($datas2 as $coba) {
        //     if ($coba->jenis_iuran_id) {
        //         $post['jenis_iuran_id'] = $coba->jenis_iuran_id;
        //     }
        //     $post['saldo_jenis'] = $coba->saldo_jenis;

        //     $post2['saldo_sisa_status'] = $coba->saldo_status;
        //     $post2['saldo_sisa_kategori'] = 'L';
        //     $post2['saldo_sisa_nominal'] = $coba->jumlah;

        //     $saldo = saldo_sisa::where($post)->first();

        //     if (!$saldo) {
        //         $pos = [...$post, ...$post2];
        //         $pos['saldo_sisa_sebelum'] = 0;
        //         $pos['saldo_sisa_sekarang'] = $pos['saldo_sisa_nominal'];

        //         saldo_sisa::create($pos);
        //     } else {
        //         $posU = [...$post2];

        //         $posU['saldo_sisa_sebelum'] = $saldo->saldo_sisa_sekarang;
        //         $posU['saldo_sisa_sekarang'] = ($coba->saldo_status == 'masuk') ? $saldo->saldo_sisa_sekarang + $posU['saldo_sisa_nominal'] : $saldo->saldo_sisa_sekarang - $posU['saldo_sisa_nominal'];

        //         $saldo->update($posU);
        //     }
        // }

        // dd('ss');

        $load['saldo_sisa'] = saldo_sisa::where('saldo_sisa_kategori', $userLogin->user_jenis_kelamin)
            ->leftJoin('ref_jenis_uangs', 'saldo_sisas.saldo_jenis', '=', 'ref_jenis_uangs.jenis_uang_id')
            ->leftJoin('ref_jenis_iurans', 'saldo_sisas.jenis_iuran_id', '=', 'ref_jenis_iurans.jenis_iuran_id')->get();
        $load['arr_bulan'] = $arr_bln;
        $load['userLogin'] = Auth::user();
        $load['saldo_terakhir'] = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['saldo_masuk_terakhir'] = saldo::where('saldo_status', 'masuk')->where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['saldo_keluar_terakhir'] = saldo::where('saldo_status', 'keluar')->where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['bulan'] = $arr_bln[$bulan];
        $load['tahun'] = $tahun;
        $load['masukPerbulan'] = $masukPerbulan;
        $load['keluarPerbulan'] = $keluarPerbulan;
        $load['jenis_uang'] = ref_jenis_uang::where('jenis_uang_kategori', $userLogin->user_jenis_kelamin)->get();
        $load['ref_nominal'] = ref_nominal::where('nominal_kategori', $userLogin->user_jenis_kelamin)->get();
        $load['saldoPerJenis'] = $datas2;
        $load['jenis_iuran'] = ref_jenis_iuran::where('jenis_iuran_kategori', $userLogin->user_jenis_kelamin)->get();

        return view('home', $load);
    }
}
