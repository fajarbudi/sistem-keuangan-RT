<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $pesanValidasi = [
        'required' => 'Form :attribute tidak boleh dikosongkan',
        'email'    => 'Form :attribute masukkan alamat email yang valid',
    ];

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function goLogin(Request $request)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token') {
                $post[$key] = trim($val);
            }
        }

        $validator = Validator::make($post, [
            'user_username' => ['required', 'string'],
            'password' => ['required']
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            if (FacadesAuth::attempt($post)) {
                $request->session()->regenerate();

                $userLogin = FacadesAuth::user()->user_nama;

                return redirect('/dashboard')->with('Berhasil', "Berhasil Login Sebagai $userLogin");
            }

            return back()->with('Gagal', 'Akun Yang Anda Masukkan Salah');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function goRegister(Request $request)
    {
        $post = [];
        foreach ($request->all() as $key => $val) {
            if ($key != '_token') {
                $post[$key] = trim($val);
            }
        }

        $post['user_role'] = 'superAdmin';

        $validator = Validator::make($post, [
            'user_nama' => ['required', 'string'],
            'user_username' => ['required', 'string'],
        ], $this->pesanValidasi);

        if (!$validator->fails()) {
            User::create($post);

            return redirect('/auth')->with('Berhasil', 'Registrasi Berhasil');
        } else {
            return back()->with('Gagal', $validator->errors()->first());
        }
    }

    public function logout(Request $request)
    {
        FacadesAuth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/auth');
    }
}
