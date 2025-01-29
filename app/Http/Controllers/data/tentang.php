<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\tentang as DataTentang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class tentang extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
        'unique'    => 'Nomor Urutan Sudah Digunakan',
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'Tentang';
        $load['judulPage'] = 'Data Tentang';
        $load['baseURL'] = url('/data/tentang');
        $filter = [];

        $query = DataTentang::select('*');
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
        $datas = $query->get();
        $load['data'] = $datas;
        $load['vFilter'] = $filter;

        return view('data.tentang', $load);
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
            'tentang_judul' => ['required', 'string'],
            'tentang_urutan' => ['required', 'unique:tentangs'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            DataTentang::create($post);

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
            'tentang_judul' => ['required', 'string'],
            'tentang_urutan' => ['required', 'unique:tentangs'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = DataTentang::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = DataTentang::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
