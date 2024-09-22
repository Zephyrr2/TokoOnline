<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController
{
    public function register(){
        return view('register');
    }

    public function login(){
        return view('login');
    }

    function reg(Request $request){
        $nama = htmlspecialchars($request->input('username'));
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $HashedPass = Hash::make($password);

        $user = new User;
        $user->username = $nama;
        $user->email = $email;
        $user->password = $HashedPass;
        $user->save();

        return redirect('/login');
    }

    function loginProcess(Request $request){
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $request->session()->put('id_admin', $user->id_admin);
            return redirect('barang');
        } else {
            echo "Email atau password salah, Silahkan diulang kembali.";
        }
    }

    public function logout(Request $request){
        $request->session()->forget('id_admin');
        return redirect('login');
    }
}
