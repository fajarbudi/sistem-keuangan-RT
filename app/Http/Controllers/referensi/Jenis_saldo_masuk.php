<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\referensi\ref_jenis_uang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Jenis_saldo_masuk extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'JenisUang';
        $load['judulPage'] = 'Data Jenis Uang';
        $load['baseURL'] = url('/referensi/jenis_uang');
        $userLogin = Auth::user();
        $filter = [];

        $query = ref_jenis_uang::select('*');
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
        $query->where('jenis_uang_kategori', $userLogin->user_jenis_kelamin);
        $datas = $query->get();
        $load['data'] = $datas;
        $load['vFilter'] = $filter;

        return view('referensi.jenis_uang', $load);
    }

    public function addRefData(Request $request)
    {
        $userLogin = Auth::user();
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'jenis_uang_nama' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $post['jenis_uang_kategori'] = $userLogin->user_jenis_kelamin;

            ref_jenis_uang::create($post);

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
            'jenis_uang_nama' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = ref_jenis_uang::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = ref_jenis_uang::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
