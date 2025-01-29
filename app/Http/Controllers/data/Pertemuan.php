<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\pertemuan as DataPertemuan;
use App\Models\referensi\ref_jenis_iuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Pertemuan extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'Pertemuan';
        $load['judulPage'] = 'Data Pertemuan';
        $load['baseURL'] = url('/data/pertemuan');
        $filter = [];

        $query = DataPertemuan::select('*');
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

        return view('data.pertemuan', $load);
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
            'pertemuan_nama' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $post['pertemuan_kategori'] = $userLogin->user_jenis_kelamin;

            DataPertemuan::create($post);

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
            'pertemuan_nama' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = DataPertemuan::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = DataPertemuan::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
