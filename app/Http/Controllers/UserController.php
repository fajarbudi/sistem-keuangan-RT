<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\dokumen\pegawai;
use App\Models\referensi\ref_jabatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function dataView(Request $request)
    {
        $load['namaPage'] = 'User';
        $load['judulPage'] = 'Data User';
        $load['baseURL'] = url('/user');
        $filter = [];

        $query = User::select('*');
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
        $query->leftJoin('pegawais', 'pegawais.pegawai_id', '=', 'users.pegawai_id');
        $query->leftJoin('ref_jabatans', 'ref_jabatans.jabatan_id', '=', 'pegawais.jabatan_id');
        $query->leftJoin('ref_golongans', 'ref_golongans.golongan_id', '=', 'pegawais.golongan_id');
        $datas = $query->with('pegawai')->get();
        $load['data'] = $datas;
        $load['user_role'] = user_role();
        // $load['jabatan'] = ref_jabatan::with('ref_jenis_jabatan')->get();
        $load['golongan'] = DB::table('ref_golongans')->select('golongan_id', 'golongan_nama')->get();


        return view('userList', $load);
    }

    public function updateProfile()
    {
        $load['namaPage'] = 'updateProfile';
        $load['judulPage'] = 'Update Profile';
        $load['baseURL'] = url('/user/update');

        $userLogin = Auth::user();

        $load['data'] = $userLogin;
        $load['golongan_darah'] = golongan_Darah();
        // dd($load);
        return view('update_profile', $load);
    }

    public function updateData(Request $request, $id)
    {
        $postUser = [];

        foreach ($request->all() as $key => $val) {
            if (trim($val)) {

                if ($key != '_token' && $key != 'user_foto') {
                    $postUser[$key] = trim($val);
                }
            }
        }

        if ($postUser) {
            $user = User::find($id);

            if ($request->file('user_foto')) {
                if ($user->user_foto) {
                    Storage::disk('public')->delete($user->user_foto);
                }

                $gambar = $request->file('user_foto');
                $filePath = Storage::disk('public')->put("user/foto/$id", $gambar, 'public');

                $postUser['user_foto'] = $filePath;
            }

            $user->update($postUser);

            return back()->with('Berhasil', 'Data Berhasil diUpdate');
        }

        return back()->with('Gagal', 'User Tidak Ditemukan');
    }

    public function import(Request $request)
    {
        Excel::import(new UsersImport, storage_path('user.xlsx'), null, \Maatwebsite\Excel\Excel::XLSX);

        return 'berhasil';
    }
}
