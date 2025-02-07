<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\iuran as DataIuran;
use App\Models\data\iuran_data;
use App\Models\data\pertemuan;
use App\Models\data\saldo;
use App\Models\referensi\ref_jenis_iuran;
use App\Models\referensi\ref_jenis_saldo_masuk;
use App\Models\referensi\ref_nominal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Iuran extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'Iuran';
        $load['judulPage'] = 'Data Iuran';
        $load['baseURL'] = route('iuran');
        $filter = [];

        $query = pertemuan::select('*');
        if ($request->all()) {
            foreach ($request->all() as $key => $val) {
                if ($val) {
                    $filter[$key] = $val;
                }
            }

            foreach ($filter as $key => $val) {
                $query->where($key, 'like', '%' . $val . '%');
            }
        }
        $query->where('pertemuan_kategori', $userLogin->user_jenis_kelamin);
        $datas = $query->get();
        $load['data'] = $datas;
        $load['filterVal'] = $filter;
        $load['jenis_iuran'] = ref_jenis_iuran::get();

        return view('data.iuran.iuran', $load);
    }

    public function detail($id)
    {
        $load['namaPage'] = 'DetailIuran';
        $load['judulPage'] = 'Daftar Jenis Iuran';
        $load['baseURL'] = route('iuran');

        $load['data'] = DataIuran::where('pertemuan_id', $id)->get();
        $load['jenis_iuran'] = ref_jenis_iuran::get();
        $load['pertemuan_id'] = $id;

        return view('data.iuran.detail', $load);
    }

    public function addData(Request $request)
    {
        $userLogin = Auth::user();
        $jenis_iuran = $request->jenis_iuran_id;

        if ($jenis_iuran) {

            DataIuran::updateOrCreate(
                [
                    'pertemuan_id' => $request->pertemuan_id,
                    'jenis_iuran_id' => $jenis_iuran
                ],
                [
                    'iuran_kategori' => $userLogin->user_jenis_kelamin,
                    'iuran_status' => 'Input Data'
                ]
            );

            return back()->with('Berhasil', 'Data Berhasil Ditambahkan.');
        } else {
            return back()->with('Gagal', 'Pilih Jenis Iuran Dahulu');
        }
    }

    public function selesai($id)
    {
        $userLogin = Auth::user();
        $lastSaldo = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $jenisSaldo = ref_jenis_saldo_masuk::where('jenis_saldo_masuk_nama', 'Iuran')->first();
        $totalIuran = iuran_data::select(DB::raw('SUM(iuran_data_nominal) as total'))->where('iuran_id', $id)->first();
        $iuran = DataIuran::find($id);
        $keteranganSaldo = "{$iuran->pertemuan->pertemuan_nama}--{$iuran->jenis_iuran->jenis_iuran_nama}";
        $tanggal = $iuran->pertemuan->pertemuan_tgl;


        if ($jenisSaldo == null) {
            return back()->with('Gagal', 'Buat Referensi Jenis Saldo Masuk ( Iuran )');
        }

        if ($totalIuran->total <= 0) {
            return back()->with('Gagal', 'Masukkan Iuran Terlebih Dahulu');
        } else {
            saldo::create(
                [
                    'user_id' => $userLogin->user_id,
                    'saldo_keterangan' => $keteranganSaldo,
                    'saldo_status' => 'masuk',
                    'saldo_jenis' => $jenisSaldo->jenis_saldo_masuk_id,
                    'saldo_kategori' => $userLogin->user_jenis_kelamin,
                    'saldo_tgl' => $tanggal,
                    'saldo_nominal' => $totalIuran->total,
                    'saldo_total' => (isset($lastSaldo->saldo_total)) ? $lastSaldo->saldo_total + $totalIuran->total : $totalIuran->total
                ]
            );

            $iuran->update(['iuran_status' => 'selesai']);

            return back()->with('Berhasil', 'Input Iuran Telah Ditutup');
        }
    }

    public function data($id)
    {
        $load['namaPage'] = 'DataIuran';
        $load['judulPage'] = 'Daftar Warga';
        $load['baseURL'] = route('iuran.data', $id);
        $userLogin = Auth::user();

        $warga = User::where('user_jenis_kelamin', $userLogin->user_jenis_kelamin)
            ->where('user_role', '!=', 'superAdmin')->orderBy('user_nama')->get();

        $data =  iuran_data::where('iuran_id', $id)->get();

        $dataIuran = [];
        foreach ($data as $val) {
            $dataIuran[$val->user_id] = $val;
        }

        $load['warga'] = $warga;
        $load['jenis_iuran'] = ref_jenis_iuran::where('jenis_iuran_kategori', $userLogin->user_jenis_kelamin)->get();
        $load['data_iuran'] = $dataIuran;
        $load['iuran_id'] = $id;
        $load['iuran'] = DataIuran::find($id);
        $load['ref_nominal'] = ref_nominal::where('nominal_kategori', $userLogin->user_jenis_kelamin)->get();

        return view('data.iuran.data', $load);
    }

    public function updateData(Request $request)
    {
        $post = [];

        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }


        if ($request->old_nominal) {
            $dataIuran = iuran_data::where('user_id', $request->user_id)->where('iuran_id', $request->iuran_id)->first();

            $dataIuran->update(['iuran_data_nominal' => $request->iuran_data_nominal]);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {

            iuran_data::create($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        }
    }

    public function iuranWarga(Request $request)
    {
        $arr_bln   = array(1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "Mei", 6 => "Jun", 7 => "Jul", 8 => "Agu", 9 => "Sep", 10 => "Okt", 11 => "Nov", 12 => "Des");
        $tahun = ($request->tahun) ? $request->tahun : date('Y');
        $bulan = ($request->bulan) ? $request->bulan : date('n');
        $filter = [];


        $load['namaPage'] = 'IuranWargaView';
        $load['judulPage'] = 'Daftar Iuran';
        $load['baseURL'] = route('iuran.warga_view');
        $userLogin = Auth::user();

        $query = iuran_data::select('*');
        $query->leftJoin('iurans', 'iuran_datas.iuran_id', '=', 'iurans.iuran_id');
        $query->leftJoin('ref_jenis_iurans', 'iurans.jenis_iuran_id', '=', 'ref_jenis_iurans.jenis_iuran_id');
        $query->leftJoin('pertemuans', 'iurans.pertemuan_id', '=', 'pertemuans.pertemuan_id');
        $query->whereMonth('pertemuan_tgl', $bulan);
        $query->whereYear('pertemuan_tgl', $tahun);
        $query->where('user_id', $userLogin->user_id);

        $data = $query->orderBy('iuran_datas.updated_at', 'DESC')->get();



        for ($i = 5; $i >= 0; $i--) {
            $load['arr_tahun'][] = date('Y', strtotime("-$i year"));
        }

        if ($request->all()) {
            foreach ($request->all() as $key => $val) {
                if ($val && $key != 'page') {
                    $filter[$key] = $val;
                }
            }
        }

        $load['data'] = $data;
        $load['bulan'] = $arr_bln[$bulan];
        $load['arr_bulan'] = $arr_bln;
        $load['tahun'] = $tahun;
        $load['filterVal'] = $filter;

        return view('data.iuran.view_warga', $load);
    }
}
