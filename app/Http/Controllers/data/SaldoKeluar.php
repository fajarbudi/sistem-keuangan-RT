<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\saldo;
use App\Models\referensi\ref_jenis_saldo_keluar;
use App\Models\referensi\ref_nominal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SaldoKeluar extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'UangKeluar';
        $load['judulPage'] = 'Data Uang Keluar';
        $load['baseURL'] = url('/data/saldo_keluar');
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
        $query->where('saldo_status', '=', 'keluar');
        $query->whereYear('saldo_tgl', $tahun);
        $query->leftJoin('ref_jenis_saldo_keluars', 'saldos.saldo_jenis', '=', 'ref_jenis_saldo_keluars.jenis_saldo_keluar_id');
        $datas = $query->orderBy('saldos.created_at', 'DESC')->get();


        for ($i = 5; $i >= 0; $i--) {
            $load['arr_tahun'][] = date('Y', strtotime("-$i year"));
        }

        $load['data'] = $datas;
        $load['filterVal'] = $filter;
        $load['jenis_saldo_keluar'] = ref_jenis_saldo_keluar::get();
        $load['tahun'] = $tahun;
        $load['bulan'] = $arr_bln[$bulan] ?? '';
        $load['arr_bulan'] = $arr_bln;
        $load['saldo_terakhir'] = saldo::latest()->first();
        $load['ref_nominal'] = ref_nominal::where('nominal_kategori', $userLogin->user_jenis_kelamin)->get();

        return view('data.saldo_keluar', $load);
    }

    public function addRefData(Request $request)
    {
        $userLogin = Auth::user();
        $bukti = $request->file('saldo_bukti');
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $key != 'saldo_bukti') {
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

            $post['saldo_status'] = 'keluar';
            $post['saldo_total'] = (isset($lastSaldo->saldo_total)) ? $lastSaldo->saldo_total - $post['saldo_nominal'] : 0 - $post['saldo_nominal'];
            $post['user_id'] = $userLogin->user_id;
            $post['saldo_kategori'] = $userLogin->user_jenis_kelamin;

            $saldo = saldo::create($post);

            if ($saldo && $bukti) {
                $gambarPath = Storage::disk('public')->put("saldo/bukti/" . $saldo->saldo_id, $bukti, 'public');

                saldo::updateOrCreate(
                    [
                        'saldo_id' => $saldo->saldo_id
                    ],
                    [
                        'saldo_bukti' => $gambarPath,
                    ]
                );
            }

            return back()->with('Berhasil', 'Data Berhasil Ditambahkan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function updateRefData(Request $request, $id)
    {
        $bukti = $request->file('saldo_bukti');
        $userLogin = Auth::user();
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $key != 'saldo_bukti') {
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
            $data = saldo::find($id);


            if ($bukti) {
                if ($data['saldo_bukti']) {
                    Storage::disk('public')->delete($data['saldo_bukti']);
                }
                $gambarPath = Storage::disk('public')->put("peraturan/foto/" . $data->saldo_id, $bukti, 'public');

                $post['saldo_bukti'] = $gambarPath;
            }

            // if (isset($lastSaldo->saldo_total) && $request->old_saldo) {
            //     $hitungSaldo = ($lastSaldo->saldo_total + $request->old_saldo) - $request->saldo_nominal;
            // } else {
            //     $hitungSaldo = $post['saldo_nominal'];
            // }

            // $post['saldo_total'] = $hitungSaldo;
            $post['user_id'] = $userLogin->user_id;

            if ($data->saldo_nominal != $post['saldo_nominal']) {

                $dataHarusUpdate = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->whereBetween('created_at', [$data->created_at, $lastSaldo->created_at])->get();

                foreach ($dataHarusUpdate as $keyU => $vUpdate) {
                    $post2 = [];
                    $saldoSebelum = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '<', $vUpdate->saldo_id)->latest()->first();


                    if ($keyU == 0) {
                        $post2['saldo_nominal'] = $request->saldo_nominal;
                        $post2['saldo_total'] = $saldoSebelum->saldo_total - $request->saldo_nominal;
                    } else {
                        $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total - $vUpdate->saldo_nominal;
                    }

                    $update2 = saldo::find($vUpdate->saldo_id);

                    // dd($saldoSebelum);

                    $update2->update($post2);
                }
            } else {
                $data->update($post);
            } 

            // $data->update($post);

            // $lastSaldo->update([
            //     'saldo_total' => $hitungSaldo
            // ]);

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
        // $dataSebelumHapus = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '<', $data->saldo_id)->latest()->first();
        $dataSetelahHapus = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '>', $data->saldo_id)->first();

        if ($data) {

            // $hitungSaldo = $lastSaldo->saldo_total + $data->saldo_nominal;

            // $lastSaldo->update([
            //     'saldo_total' => $hitungSaldo
            // ]);
            $data->delete();

            if (isset($dataSetelahHapus->created_at)) {
                $dataHarusUpdate = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->whereBetween('created_at', [$dataSetelahHapus->created_at, $lastSaldo->created_at])->get();

                // dd($dataHarusUpdate);

                foreach ($dataHarusUpdate as $keyU => $vUpdate) {
                    $post2 = [];
                    $saldoSebelum = saldo::where('saldo_kategori', $userLogin->user_jenis_kelamin)->where('saldo_id', '<', $vUpdate->saldo_id)->latest()->first();

                    // if ($keyU == 0) {
                    //     $post2['saldo_nominal'] = $vUpdate->saldo_nominal;
                    //     $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $dataSebelumHapus->saldo_total + $vUpdate->saldo_nominal : $dataSebelumHapus->saldo_total - $vUpdate->saldo_nominal;
                    // } else {
                    //     $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total - $vUpdate->saldo_nominal;
                    // }

                    // $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total ?? 0 + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total ?? 0 - $vUpdate->saldo_nominal;

                    // $update2 = saldo::find($vUpdate->saldo_id);
                    // $update2->update($post2);

                    // if (isset($saldoSebelum->saldo_total)) {
                    //     $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total - $vUpdate->saldo_nominal;

                    //     $update2 = saldo::find($vUpdate->saldo_id);
                    //     $update2->update($post2);
                    // }

                    if (!isset($saldoSebelum->saldo_total)) {
                        $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? 0 + $vUpdate->saldo_nominal : 0 - $vUpdate->saldo_nominal;

                        $update2 = saldo::find($vUpdate->saldo_id);
                        $update2->update($post2);
                    } else {
                        $post2['saldo_total'] = ($vUpdate->saldo_status == 'masuk') ? $saldoSebelum->saldo_total + $vUpdate->saldo_nominal : $saldoSebelum->saldo_total - $vUpdate->saldo_nominal;

                        $update2 = saldo::find($vUpdate->saldo_id);
                        $update2->update($post2);
                    }
                }

                // dd($dataHarusUpdate);
            }


            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
