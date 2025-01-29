<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\peraturan as DataPeraturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class peraturan extends Controller
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
        $load['namaPage'] = 'Peraturan';
        $load['judulPage'] = 'Data Peraturan';
        $load['baseURL'] = url('/data/peraturan');
        $filter = [];

        $query = DataPeraturan::select('*');
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

        return view('data.peraturan', $load);
    }

    public function addRefData(Request $request)
    {
        $post = [];
        $peraturan_gambar = '';
        $peraturan_pdf = '';
        $gambar = $request->file('peraturan_gambar');
        $pdf = $request->file('peraturan_pdf');
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($request->all(), [
            'peraturan_judul' => ['required'],
            // 'peraturan_isi' => ['required', 'string'],
            'peraturan_gambar' => ['mimes:png,jpg,jpeg,jpe,bmp'],
            'peraturan_pdf' => ['mimes:pdf'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $peraturan = DataPeraturan::create($post);

            if ($peraturan) {
                if ($gambar) {
                    $gambarPath = Storage::disk('public')->put("peraturan/foto/" . $peraturan->peraturan_id, $gambar, 'public');

                    $peraturan_gambar = $gambarPath;
                }
                if ($pdf) {
                    $pdfPath = Storage::disk('public')->put("peraturan/pdf/" . $peraturan->peraturan_id, $pdf, 'public');

                    $peraturan_pdf = $pdfPath;
                }

                DataPeraturan::updateOrCreate(
                    [
                        'peraturan_id' => $peraturan->peraturan_id
                    ],
                    [
                        'peraturan_gambar' => $peraturan_gambar,
                        'peraturan_pdf' => $peraturan_pdf
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
        $gambar = $request->file('peraturan_gambar');
        $pdf = $request->file('peraturan_pdf');
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($request->all(), [
            'peraturan_judul' => ['required'],
            // 'peraturan_isi' => ['required', 'string'],
            'peraturan_gambar' => ['mimes:png,jpg,jpeg,jpe,bmp'],
            'peraturan_pdf' => ['mimes:pdf'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = DataPeraturan::find($id);

            if ($gambar) {
                Storage::disk('public')->delete($data['peraturan_gambar']);
                $gambarPath = Storage::disk('public')->put("peraturan/foto/" . $data['peraturan_id'], $gambar, 'public');

                $post['peraturan_gambar'] = $gambarPath;
            }
            if ($pdf) {
                Storage::disk('public')->delete($data['peraturan_pdf']);
                $pdfPath = Storage::disk('public')->put("peraturan/pdf/" . $data['peraturan_id'], $pdf, 'public');

                $post['peraturan_pdf'] = $pdfPath;
            }

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = DataPeraturan::find($id);

        if ($data) {
            Storage::disk('public')->delete($data['peraturan_gambar']);
            Storage::disk('public')->delete($data['peraturan_pdf']);
            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
