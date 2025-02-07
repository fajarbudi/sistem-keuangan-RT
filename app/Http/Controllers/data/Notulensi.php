<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\notulensi as DataNotulensi;
use App\Models\data\notulensi_data;
use App\Models\data\pertemuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Notulensi extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'Notulensi';
        $load['judulPage'] = 'Data Notulensi';
        $load['baseURL'] = route('notulensi');
        $userLogin = Auth::user();
        $filter = [];

        $query = DataNotulensi::select('*');
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
        $query->where('notulensi_kategori', $userLogin->user_jenis_kelamin);
        $datas = $query->with('user')->latest()->get();
        $load['data'] = $datas;
        $load['vFilter'] = $filter;

        return view('data.notulensi.notulensi', $load);
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
            'notulensi_topik' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $post['user_id'] = $userLogin->user_id;
            $post['notulensi_kategori'] = $userLogin->user_jenis_kelamin;

            DataNotulensi::create($post);

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
            'notulensi_topik' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $post['user_id'] = $userLogin->user_id;
            $data = DataNotulensi::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = DataNotulensi::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }


    public function detail($id)
    {
        $load['namaPage'] = 'DataNotulensi';
        $load['judulPage'] = 'Hasil Diskusi';
        $load['baseURL'] = route('notulensi.detail', $id);
        $userLogin = Auth::user();

        $data =  notulensi_data::where('notulensi_id', $id)->with('pertemuan')->latest()->get();

        $load['datas'] = $data;
        $load['notulensi_id'] = $id;
        $load['pertemuan'] = pertemuan::where('pertemuan_kategori', $userLogin->user_jenis_kelamin)->latest()->get();

        return view('data.notulensi.detail', $load);
    }

    public function addDetail(Request $request)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'notulensi_isi' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {

            notulensi_data::updateOrCreate(
                [
                    'pertemuan_id' => $request->pertemuan_id
                ],
                $post
            );

            return back()->with('Berhasil', 'Data Berhasil Ditambahkan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function updateDetail(Request $request, $notulen_id, $id)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'notulensi_isi' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = notulensi_data::find($id);

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellDetail($notulen_id, $id)
    {
        $data = notulensi_data::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
