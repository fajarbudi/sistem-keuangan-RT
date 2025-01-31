<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\saldo;
use App\Models\referensi\ref_jenis_saldo_masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SaldoMasuk extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'SaldoMasuk';
        $load['judulPage'] = 'Data Saldo Masuk';
        $load['baseURL'] = url('/data/saldo_masuk');
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
        $query->leftJoin('ref_jenis_saldo_masuks', 'saldos.saldo_jenis', '=', 'ref_jenis_saldo_masuks.jenis_saldo_masuk_id');
        $datas = $query->orderBy('saldos.updated_at', 'DESC')->get();


        for ($i = 5; $i >= 0; $i--) {
            $load['arr_tahun'][] = date('Y', strtotime("-$i year"));
        }

        $load['data'] = $datas;
        $load['filterVal'] = $filter;
        $load['jenis_saldo_masuk'] = ref_jenis_saldo_masuk::get();
        $load['tahun'] = $tahun;
        $load['bulan'] = $arr_bln[$bulan];
        $load['arr_bulan'] = $arr_bln;
        $load['saldo_terakhir'] = saldo::latest()->first();

        return view('data.saldo_masuk', $load);
    }

    public function addRefData(Request $request)
    {
        $userLogin = Auth::user();
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'saldo_keterangan' => ['required', 'string'],
            'saldo_tgl' => ['required', 'Date'],
            'saldo_nominal' => ['required', 'integer'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $lastSaldo = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();

            $post['saldo_status'] = 'masuk';
            $post['saldo_total'] = (isset($lastSaldo->saldo_total)) ? $lastSaldo->saldo_total + $post['saldo_nominal'] : $post['saldo_nominal'];
            $post['user_id'] = $userLogin->user_id;
            $post['saldo_kategori'] = $userLogin->user_jenis_kelamin;

            saldo::create($post);

            return back()->with('Berhasil', 'Data Berhasil Ditambahkan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function updateRefData(Request $request, $id)
    {
        $userLogin = Auth::user();
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'saldo_keterangan' => ['required', 'string'],
            'saldo_tgl' => ['required', 'Date'],
            'saldo_nominal' => ['required', 'integer'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $lastSaldo = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();

            if (isset($lastSaldo->saldo_total) && $request->old_saldo) {
                $hitungSaldo = ($lastSaldo->saldo_total - $request->old_saldo) + $request->saldo_nominal;
            } else {
                $hitungSaldo = $post['saldo_nominal'];
            }

            $post['saldo_total'] = $hitungSaldo;
            $post['user_id'] = $userLogin->user_id;

            $lastSaldo->update([
                'saldo_total' => $hitungSaldo
            ]);

            $data = saldo::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $userLogin = Auth::user();
        $data = saldo::find($id);
        $lastSaldo = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();

        if ($data) {

            $hitungSaldo = $lastSaldo->saldo_total - $data->saldo_nominal;

            $lastSaldo->update([
                'saldo_total' => $hitungSaldo
            ]);

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
