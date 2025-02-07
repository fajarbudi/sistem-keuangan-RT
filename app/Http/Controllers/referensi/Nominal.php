<?php

namespace App\Http\Controllers\referensi;

use App\Http\Controllers\Controller;
use App\Models\referensi\ref_nominal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Nominal extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'Nominal';
        $load['judulPage'] = 'Data Nominal';
        $load['baseURL'] = url('/referensi/nominal');
        $userLogin = Auth::user();
        $filter = [];

        $query = ref_nominal::select('*');
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
        $query->where('nominal_kategori', $userLogin->user_jenis_kelamin);
        $datas = $query->get();
        $load['data'] = $datas;
        $load['vFilter'] = $filter;

        return view('referensi.nominal', $load);
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
            'nominal_nominal' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $post['nominal_kategori'] = $userLogin->user_jenis_kelamin;

            ref_nominal::create($post);

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
            'nominal' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            // dd($id);
            $data = ref_nominal::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = ref_nominal::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
