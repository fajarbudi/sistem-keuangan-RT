<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\pengumuman as DataPengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class pengumuman extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
        'mimes' => [
            'png' => 'Form :attribute harus berformat PNG',
            'pdf' => 'Form :attribute harus berformat PDF',
        ]
    ];

    public function dataView(Request $request)
    {
        $load['namaPage'] = 'Pengumuman';
        $load['judulPage'] = 'Data Pengumuman';
        $load['baseURL'] = url('/data/pengumuman');
        $filter = [];

        $query = DataPengumuman::select('*');
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

        return view('data.pengumuman', $load);
    }

    public function addRefData(Request $request)
    {
        $post = [];
        $pengumuman_gambar = '';
        $pengumuman_pdf = '';
        $gambar = $request->file('pengumuman_gambar');
        $pdf = $request->file('pengumuman_pdf');
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($request->all(), [
            'pengumuman_judul' => ['required'],
            // 'pengumuman_isi' => ['required', 'string'],
            'pengumuman_gambar' => ['mimes:png,jpg,jpeg,jpe,bmp'],
            'pengumuman_pdf' => ['mimes:pdf'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $pengumuman = DataPengumuman::create($post);

            if ($pengumuman) {
                if ($gambar) {
                    $gambarPath = Storage::disk('public')->put("pengumuman/foto/" . $pengumuman->pengumuman_id, $gambar, 'public');

                    $pengumuman_gambar = $gambarPath;
                }
                if ($pdf) {
                    $pdfPath = Storage::disk('public')->put("pengumuman/pdf/" . $pengumuman->pengumuman_id, $pdf, 'public');

                    $pengumuman_pdf = $pdfPath;
                }

                DataPengumuman::updateOrCreate(
                    [
                        'pengumuman_id' => $pengumuman->pengumuman_id
                    ],
                    [
                        'pengumuman_gambar' => $pengumuman_gambar,
                        'pengumuman_pdf' => $pengumuman_pdf
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
        $post = [];
        $gambar = $request->file('pengumuman_gambar');
        $pdf = $request->file('pengumuman_pdf');
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($request->all(), [
            'pengumuman_judul' => ['required'],
            // 'pengumuman_isi' => ['required', 'string'],
            'pengumuman_gambar' => ['mimes:png,jpg,jpeg,jpe,bmp'],
            'pengumuman_pdf' => ['mimes:pdf'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = DataPengumuman::find($id);

            if ($gambar) {
                if ($data['pengumuman_gambar']) Storage::disk('public')->delete($data['pengumuman_gambar']);
                $gambarPath = Storage::disk('public')->put("pengumuman/foto/" . $data['pengumuman_id'], $gambar, 'public');

                $post['pengumuman_gambar'] = $gambarPath;
            }
            if ($pdf) {
                if ($data['pengumuman_pdf']) Storage::disk('public')->delete($data['pengumuman_pdf']);
                $pdfPath = Storage::disk('public')->put("pengumuman/pdf/" . $data['pengumuman_id'], $pdf, 'public');

                $post['pengumuman_pdf'] = $pdfPath;
            }

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = DataPengumuman::find($id);

        if ($data) {
            if ($data['pengumuman_gambar']) Storage::disk('public')->delete($data['pengumuman_gambar']);
            if ($data['pengumuman_pdf']) Storage::disk('public')->delete($data['pengumuman_pdf']);
            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
