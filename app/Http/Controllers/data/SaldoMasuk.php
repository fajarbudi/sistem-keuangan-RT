<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\saldo;
use App\Models\data\saldo_sisa;
use App\Models\referensi\ref_jenis_iuran;
use App\Models\referensi\ref_jenis_saldo_masuk;
use App\Models\referensi\ref_jenis_uang;
use App\Models\referensi\ref_nominal;
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
        $load['namaPage'] = 'UangMasuk';
        $load['judulPage'] = 'Data Uang Masuk';
        $load['baseURL'] = url('/data/saldo_masuk');
        $tahun = ($request->tahun) ? $request->tahun : date('Y');
        $bulan = ($request->bulan) ? $request->bulan : '';
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
        if ($request->bulan) {
            $query->whereMonth('saldo_tgl', $bulan);
        }
        $query->where('saldo_kategori', $userLogin->user_jenis_kelamin);
        $query->where('saldo_status', '=', 'masuk');
        $query->whereYear('saldo_tgl', $tahun);
        $query->leftJoin('ref_jenis_uangs', 'saldos.saldo_jenis', '=', 'ref_jenis_uangs.jenis_uang_id');
        // $query->leftJoin('ref_jenis_saldo_masuks', 'saldos.saldo_jenis', '=', 'ref_jenis_saldo_masuks.jenis_saldo_masuk_id');
        $query->leftJoin('ref_jenis_iurans', 'saldos.jenis_iuran_id', '=', 'ref_jenis_iurans.jenis_iuran_id');
        $datas = $query->orderBy('saldos.created_at', 'DESC')->get();

        // dd($datas);


        for ($i = 5; $i >= 0; $i--) {
            $load['arr_tahun'][] = date('Y', strtotime("-$i year"));
        }

        $load['data'] = $datas;
        $load['filterVal'] = $filter;
        $load['jenis_uang'] = ref_jenis_uang::where('jenis_uang_kategori', $userLogin->user_jenis_kelamin)->get();
        $load['tahun'] = $tahun;
        $load['bulan'] = $arr_bln[$bulan] ?? '';
        $load['arr_bulan'] = $arr_bln;
        $load['saldo_terakhir'] = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();
        $load['ref_nominal'] = ref_nominal::where('nominal_kategori', $userLogin->user_jenis_kelamin)->get();
        $load['jenis_iuran'] = ref_jenis_iuran::where('jenis_iuran_kategori', $userLogin->user_jenis_kelamin)->get();

        return view('data.saldo_masuk', $load);
    }

    public function addRefData(Request $request)
    {
        $userLogin = Auth::user();
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val) {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'saldo_keterangan' => ['required', 'string'],
            'saldo_tgl' => ['required', 'Date'],
            'saldo_nominal' => ['required', 'integer'],
            'saldo_jenis' => ['required']
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $lastSaldo = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();

            $post['saldo_status'] = 'masuk';
            $post['saldo_total'] = (isset($lastSaldo->saldo_total)) ? $lastSaldo->saldo_total + $post['saldo_nominal'] : 0 + $post['saldo_nominal'];
            $post['user_id'] = $userLogin->user_id;
            $post['saldo_kategori'] = $userLogin->user_jenis_kelamin;

            saldo::create($post);

            //create sisa saldo
            if ($request->jenis_iuran_id) {
                $uniq['jenis_iuran_id'] = $request->jenis_iuran_id;
            }
            $uniq['saldo_jenis'] = $request->saldo_jenis;

            $post2['saldo_sisa_status'] = 'masuk';
            $post2['saldo_sisa_kategori'] = $userLogin->user_jenis_kelamin;
            $post2['saldo_sisa_nominal'] = $request->saldo_nominal;

            $saldo = saldo_sisa::where($uniq)->first();

            if (!$saldo) {
                $pos = [...$uniq, ...$post2];
                $pos['saldo_sisa_sebelum'] = 0;
                $pos['saldo_sisa_sekarang'] = $pos['saldo_sisa_nominal'];

                saldo_sisa::create($pos);
            } else {
                $posU = [...$post2];

                $posU['saldo_sisa_sebelum'] = $saldo->saldo_sisa_sekarang;
                $posU['saldo_sisa_sekarang'] = $saldo->saldo_sisa_sekarang + $posU['saldo_sisa_nominal'];

                $saldo->update($posU);
            }

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
            $data = saldo::find($id);
            $lastSaldo = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->latest()->first();

            // if (isset($lastSaldo->saldo_total) && $request->old_saldo) {
            //     $hitungSaldo = ($lastSaldo->saldo_total - $request->old_saldo) + $request->saldo_nominal;
            // } else {
            //     $hitungSaldo = $post['saldo_nominal'];
            // }

            // $post['saldo_total'] = $hitungSaldo;
            $post['user_id'] = $userLogin->user_id;

            // $lastSaldo->update([
            //     'saldo_total' => $hitungSaldo
            // ]);



            if ($data->saldo_nominal != $post['saldo_nominal']) {

                $dataHarusUpdate = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->whereBetween('created_at', [$data->created_at, $lastSaldo->created_at])->get();

                foreach ($dataHarusUpdate as $keyU => $vUpdate) {
                    $saldoSebelum = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '<', $vUpdate->saldo_id)->latest()->first();


                    if ($keyU == 0) {
                        $post2 = [];
                        $post2['saldo_nominal'] = $request->saldo_nominal;
                        $post2['saldo_total'] = $saldoSebelum->saldo_total ? $saldoSebelum->saldo_total + $request->saldo_nominal : 0 + $request->saldo_nominal;

                        $update2 = saldo::find($vUpdate->saldo_id);
                        $update2->update($post2);
                    } else {
                        $post3 = [];
                        $post3['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total - $vUpdate->saldo_nominal;

                        $update3 = saldo::find($vUpdate->saldo_id);
                        $update3->update($post3);
                    }
                }


                //create sisa saldo
                if ($request->jenis_iuran_id) {
                    $uniq['jenis_iuran_id'] = $request->jenis_iuran_id;
                }
                $uniq['saldo_jenis'] = $request->saldo_jenis;

                $post2['saldo_sisa_status'] = 'masuk';
                $post2['saldo_sisa_kategori'] = $userLogin->user_jenis_kelamin;
                $post2['saldo_sisa_nominal'] = $request->saldo_nominal;

                $saldo = saldo_sisa::where($uniq)->first();

                if (!$saldo) {
                    $pos = [...$uniq, ...$post2];
                    $pos['saldo_sisa_sebelum'] = 0;
                    $pos['saldo_sisa_sekarang'] = $pos['saldo_sisa_nominal'];

                    saldo_sisa::create($pos);
                } else {
                    $posU = [...$post2];

                    $posU['saldo_sisa_sebelum'] = $saldo->saldo_sisa_sekarang;
                    $posU['saldo_sisa_sekarang'] = ($saldo->saldo_sisa_sekarang - $data->saldo_nominal) + $posU['saldo_sisa_nominal'];

                    $saldo->update($posU);
                }
            } else {
                $data->update($post);
            }       

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
        $dataSetelahHapus = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '>', $data->saldo_id)->first();

        if ($data) {

            //create sisa saldo
            $uniq['jenis_iuran_id'] = $data->jenis_iuran_id;
            $uniq['saldo_jenis'] = $data->saldo_jenis;

            $post2['saldo_sisa_status'] = 'masuk';
            $post2['saldo_sisa_kategori'] = $userLogin->user_jenis_kelamin;
            $post2['saldo_sisa_nominal'] = $data->saldo_nominal;

            $saldo = saldo_sisa::where($uniq)->first();

            if (!$saldo) {
                $pos = [...$uniq, ...$post2];
                $pos['saldo_sisa_sebelum'] = 0;
                $pos['saldo_sisa_sekarang'] = $pos['saldo_sisa_nominal'];

                saldo_sisa::create($pos);
            } else {
                $posU = [...$post2];

                $posU['saldo_sisa_sebelum'] = $saldo->saldo_sisa_sekarang;
                $posU['saldo_sisa_sekarang'] = $saldo->saldo_sisa_sekarang - $posU['saldo_sisa_nominal'];

                $saldo->update($posU);
            }


            $data->delete();

            if (isset($dataSetelahHapus->created_at)) {
                $dataHarusUpdate = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->whereBetween('created_at', [$dataSetelahHapus->created_at, $lastSaldo->created_at])->get();

                // dd($dataHarusUpdate);

                foreach ($dataHarusUpdate as $keyU => $vUpdate) {
                    $saldoSebelum = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '<', $vUpdate->saldo_id)->latest()->first();

                    // $hasil = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total ?? 0 + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total ?? 0 - $vUpdate->saldo_nominal;

                    // $update2 = saldo::find($vUpdate->saldo_id);
                    // $update2->update([
                    //     'saldo_total' => $hasil
                    // ]);

                    if (!isset($saldoSebelum->saldo_total)) {
                        $post2 = [];
                        $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? 0 + $vUpdate->saldo_nominal : 0 - $vUpdate->saldo_nominal;

                        $update2 = saldo::find($vUpdate->saldo_id);
                        $update2->update($post2);
                    } else {
                        $post3 = [];
                        $post3['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total - $vUpdate->saldo_nominal;

                        $update3 = saldo::find($vUpdate->saldo_id);
                        $update3->update($post3);
                    }
                }

            }

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
