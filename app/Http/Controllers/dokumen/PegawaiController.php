<?php

namespace App\Http\Controllers\dokumen;

use App\Http\Controllers\Controller;
use App\Models\dokumen\pegawai;
use App\Models\referensi\ref_bidang;
use App\Models\referensi\ref_gaji;
use App\Models\referensi\ref_jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
        'unique' => 'Username Sudah Digunakan'
    ];

    function inp()
    {
        //
        die;
        $getpeg = DB::table('peg')->get();
        $cek_gol = '';
        foreach ($getpeg as $v) {
            $pegawai = [];
            $cek_gol = DB::table('ref_golongans')->where('golongan_nama', '=', trim($v->golongan))->first();
            if ($cek_gol) {
                $pegawai['golongan_id'] = $cek_gol->golongan_id;
            } else {
                $pegawai['golongan_id'] = DB::table('ref_golongans')->insertGetId(
                    ['golongan_nama' => trim($v->golongan), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                );
            }

            $cek_pendidikan = DB::table('ref_pendidikans')->where('pendidikan_nama', '=', trim($v->pendidikan))->first();
            if ($cek_pendidikan) {
                $pegawai['pendidikan_id'] = $cek_pendidikan->pendidikan_id;
            } else {
                $pegawai['pendidikan_id'] = DB::table('ref_pendidikans')->insertGetId(
                    ['pendidikan_nama' => trim($v->pendidikan), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                );
            }

            $cek_jabatan = DB::table('ref_jabatans')->where('jabatan_nama', '=', trim($v->jabatan))->first();
            if ($cek_jabatan) {
                $pegawai['jabatan_id'] = $cek_jabatan->jabatan_id;
            } else {
                $jb = trim($v->jenis_jabatan);
                $jen_jb = 0;
                if ($jb == 'Struktural') {
                    $jen_jb = 22;
                } elseif ($jb == 'Fungsional') {
                    $jen_jb = 23;
                } elseif ($jb == 'Pelaksana') {
                    $jen_jb = 24;
                }
                $pegawai['jabatan_id'] = DB::table('ref_jabatans')->insertGetId(
                    ['jabatan_nama' => trim($v->jabatan), 'jenis_jabatan_id' => $jen_jb, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                );
            }
            $pegawai['pegawai_nip'] = trim($v->pegawai_nip);
            $pegawai['pegawai_nama'] = trim($v->pegawai_nama);
            $pegawai['pegawai_tempat_lahir'] = trim($v->pegawai_tempat_lahir);
            $pegawai['pegawai_tgl_lahir'] = trim($v->pegawai_tgl_lahir);
            $pegawai['pegawai_kelamin'] = trim($v->pegawai_kelamin);
            $pegawai['pegawai_status'] = trim($v->pegawai_status);
            $pegawai['pegawai_alamat'] = trim($v->pegawai_alamat);
            $pegawai['pegawai_ktp'] = trim($v->pegawai_ktp);
            $pegawai['pegawai_npwp'] = trim($v->pegawai_npwp);
            $pegawai['pegawai_hp'] = trim($v->pegawai_hp);
            $pegawai['pegawai_email'] = trim($v->pegawai_email);
            $pegawai['pegawai_email_pupr'] = trim($v->pegawai_email_pupr);
            $pegawai['pegawai_agama'] = trim($v->pegawai_agama);
            $pegawai['pegawai_tmt_cpns'] = trim($v->pegawai_tmt_cpns);
            // $pegawai['pegawai_masa_kerja_golongan'] = trim($v->pegawai_masa_kerja_golongan);
            $pegawai['pegawai_tmt_golongan'] = trim($v->pegawai_tmt_golongan);
            $pegawai['pegawai_tmt_jabatan'] = date('Y-m-d', strtotime(trim($v->pegawai_tmt_jabatan)));
            $pegawai['pegawai_nomor_sk'] = trim($v->pegawai_nomor_sk);
            $pegawai['pegawai_diklat'] = trim($v->pegawai_diklat);
            $pegawai['pegawai_tahun_lulus'] = trim($v->pegawai_tahun_lulus);
            $pegawai['pegawai_sekolah'] = trim($v->pegawai_sekolah);
            $pegawai['pegawai_bidang_studi'] = trim($v->pegawai_bidang_studi);
            $pegawai['pegawai_jurusan'] = trim($v->pegawai_jurusan);
            $pegawai['pegawai_tmt_pensiun'] = trim($v->pegawai_tmt_pensiun);

            $cpeg = pegawai::create($pegawai);

            $posVal = [];
            $posVal['user_nama'] = $cpeg->pegawai_id;
            $posVal['user_nama'] = $pegawai['pegawai_nama'];
            $posVal['user_role'] = 'user';
            $posVal['user_email'] = $pegawai['pegawai_email'];
            $posVal['user_username'] = $pegawai['pegawai_nip'];
            $posVal['password'] = '12345';
            User::create($posVal);
        }
        print_r($pegawai);
    }

    public function dataView(Request $request)
    {
        $userLogin = Auth::user();
        $load['namaPage'] = 'Warga';
        $load['judulPage'] = 'Data Warga';
        $load['baseURL'] = url('/warga');
        $filter = [];

        $query = User::select('*');
        if ($request->all()) {
            foreach ($request->all() as $key => $val) {
                if ($val && $key != 'page') {
                    $filter[$key] = $val;
                }
            }

            foreach ($filter as $key => $val) {
                $query->where($key, 'like', '%' . $val . '%');
            }
        }
        $query->where('user_role', '!=', 'superAdmin');
        $query->where('user_jenis_kelamin', $userLogin->user_jenis_kelamin);
        $datas = $query->orderBy('user_nama')->paginate(50);

        $load['data'] = $datas;

        $load['user_role'] = user_role();
        $load['vFilter'] = $filter;
        $load['golongan_darah'] = golongan_Darah();
        $load['mulaiNo'] = (($request->page ?? 1) * 50) - 50;

        return view('dokumen.pegawai', $load);
    }

    public function addData(Request $request)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val) {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'user_nama' => ['required', 'string'],
            'user_username' => ['required', 'unique:users'],
            'user_email' => ['required'],
            'password' => ['required'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            $post['user_role'] = 'Warga';
            $pegawai = User::create($post);

            return back()->with('Berhasil', 'Data Berhasil Ditambahkan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function updateData(Request $request, $id)
    {
        $post = [];
        $data = User::find($id);
        foreach ($request->all() as $key => $val) {
            if ($key != '_token' && $val) {
                $post[$key] = trim($val);
            }
        }
        if (!$data) {
            return back()->with('Gagal', 'Tidak terdaftar di data pegawai');
        }

        if ($data->user_username != $request->user_username) {
            $validator = Validator::make($post, [
                'user_nama' => ['required', 'string'],
                'user_username' => ['required', 'unique:users'],
            ], $this->pesanValidasi);
        } else {
            $validator = Validator::make($post, [
                'user_nama' => ['required', 'string'],
            ], $this->pesanValidasi);
        }

        if (!$validator->fails()) {

            $data->update($post);

            return back()->with('Berhasil', 'Data Berhasil Disimpan.');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function delData($id)
    {
        $data = User::find($id);

        if ($data) {

            $data->delete();

            return back()->with('Berhasil', 'Data Berhasil Dihapus');
        } else {
            return back()->with('Gagal', 'Data Tidak Ada');
        }
    }

    public function upFoto(Request $request)
    {
        $id = $request->get('id');
        $request->validate([
            'user_foto' => 'required|mimes:jpg,png',
        ]);

        $konten = User::find($id);

        if ($konten) {
            if ($konten['user_foto']) {
                Storage::disk('public')->delete($konten['user_foto']);
            }

            $gambar = $request->file('user_foto');
            $filePath = Storage::disk('public')->put("user/foto/$id", $gambar, 'public');

            $post = [
                'user_foto' => $filePath,
            ];

            $konten->update($post);
        }

        return back();
    }
}
