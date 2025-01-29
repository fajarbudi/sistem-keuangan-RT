<?php

namespace App\Http\Controllers\data;

use App\Http\Controllers\Controller;
use App\Models\data\sop as DataSop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class sop extends Controller
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
        $load['namaPage'] = 'SOP';
        $load['judulPage'] = 'Data SOP';
        $load['baseURL'] = url('/data/sop');
        $filter = [];

        $query = DataSop::select('*');
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

        return view('data.sop', $load);
    }

    public function addRefData(Request $request)
    {
        $post = [];
        $sop_gambar = '';
        $sop_pdf = '';
        $gambar = $request->file('sop_gambar');
        $pdf = $request->file('sop_pdf');
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($request->all(), [
            'sop_judul' => ['required'],
            // 'sop_isi' => ['required', 'string'],
            'sop_gambar' => ['mimes:png,jpg,jpeg,jpe,bmp'],
            'sop_pdf' => ['mimes:pdf']
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $sop = DataSop::create($post);

            if ($sop) {
                if ($gambar) {
                    $gambarPath = Storage::disk('public')->put("sop/foto/" . $sop->sop_id, $gambar, 'public');

                    $sop_gambar = $gambarPath;
                }
                if ($pdf) {
                    $pdfPath = Storage::disk('public')->put("sop/pdf/" . $sop->sop_id, $pdf, 'public');

                    $sop_pdf = $pdfPath;
                }

                DataSop::updateOrCreate(
                    [
                        'sop_id' => $sop->sop_id
                    ],
                    [
                        'sop_gambar' => $sop_gambar,
                        'sop_pdf' => $sop_pdf
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
        $gambar = $request->file('sop_gambar');
        $pdf = $request->file('sop_pdf');
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val != '') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($request->all(), [
            'sop_judul' => ['required'],
            // 'sop_isi' => ['required', 'string'],
            'sop_gambar' => ['mimes:png,jpg,jpeg,jpe,bmp'],
            'sop_pdf' => ['mimes:pdf']
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $data = DataSop::find($id);

            if ($gambar) {
                Storage::disk('public')->delete($data['sop_gambar']);
                $gambarPath = Storage::disk('public')->put("sop/foto/" . $data['sop_id'], $gambar, 'public');

                $post['sop_gambar'] = $gambarPath;
            }
            if ($pdf) {
                Storage::disk('public')->delete($data['sop_pdf']);
                $pdfPath = Storage::disk('public')->put("sop/pdf/" . $data['sop_id'], $pdf, 'public');

                $post['sop_pdf'] = $pdfPath;
            }

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function dellRefData($id)
    {
        $data = DataSop::find($id);

        if ($data) {
            Storage::disk('public')->delete($data['sop_gambar']);
            Storage::disk('public')->delete($data['sop_pdf']);
            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }
}
