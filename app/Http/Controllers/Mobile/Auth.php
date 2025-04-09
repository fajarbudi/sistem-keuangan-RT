<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class Auth extends Controller
{
    public function mobileLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL)
        ? 'email'
        : 'user_username';

        $authVal = [
            $login_type => $request->get('username'),
            'password' => $request->get('password')
        ];

        if (!$validator->fails()) {
            if (!FacadesAuth::attempt($authVal)) {
                return response()->json([
                    'pesan' => 'Akun Yang Anda Masukkan Salah'
                ]);
            }

            $user = User::where($login_type, $request->username)->firstOrFail();

            $token = $user->createToken( "Token-$request->username", ['*'], now()->addMonth())->plainTextToken;

            return response()->json([
                'pesan' => 'Login Berhasil',
                'access_token' => $token,
                'token_type' => 'Bearer'
            ]);
        } else {
            return response()->json([
                'pesan' => $validator->errors()->first(),
            ]);
        }
    }

    public function cekToken(Request $request){
        // $token = $request->bearerToken();
        $token = request()->user()->currentAccessToken()->token;

        return $token;
    }
}
