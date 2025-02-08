<?php

namespace App\Http\Controllers;

use App\Models\data\saldo;
use App\Models\referensi\ref_jenis_saldo_keluar;
use App\Models\referensi\ref_jenis_saldo_masuk;
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

        $datas2 = saldo::select(DB::raw("saldo_status, SUM(saldo_nominal) as jumlah, saldo_jenis"))
        ->whereYear('saldo_tgl', $tahun)
            ->where('saldo_kategori', $userLogin->user_jenis_kelamin)
            ->groupBy(DB::raw('saldo_status, saldo_jenis'))->get();

        $load['arr_bulan'] = $arr_bln;
        $load['userLogin'] = Auth::user();
        $load['saldo_terakhir'] = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['saldo_masuk_terakhir'] = saldo::where('saldo_status', 'masuk')->where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['saldo_keluar_terakhir'] = saldo::where('saldo_status', 'keluar')->where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['bulan'] = $arr_bln[$bulan];
        $load['tahun'] = $tahun;
        $load['masukPerbulan'] = $masukPerbulan;
        $load['keluarPerbulan'] = $keluarPerbulan;
        $load['jenis_saldo_masuk'] = ref_jenis_saldo_masuk::where('jenis_saldo_masuk_nama', '!=', 'Iuran')->get();
        $load['jenis_saldo_keluar'] = ref_jenis_saldo_keluar::get();
        $load['ref_nominal'] = ref_nominal::where('nominal_kategori', $userLogin->user_jenis_kelamin)->get();
        $load['saldoPerJenis'] = $datas2;

        return view('home', $load);
    }
}
