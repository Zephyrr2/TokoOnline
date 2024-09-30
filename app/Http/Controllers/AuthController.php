<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Barang;
use App\Models\Transaksi;
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
    public function registerAdmin(){
        return view('registerAdmin');
    }

    public function loginAdmin(){
        return view('loginAdmin');
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
            $request->session()->put('user', true);
            $request->session()->put('id_user', $user->id_user);
            return redirect('barang');
        } else {
            echo "Email atau password salah, Silahkan diulang kembali.";
        }
    }

    function regAdmin(Request $request){
        $nama = htmlspecialchars($request->input('username'));
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $HashedPass = Hash::make($password);

        $user = new Admin;
        $user->username = $nama;
        $user->email = $email;
        $user->password = $HashedPass;
        $user->save();

        return redirect('/admin/login');
    }

    function adminLoginProcess(Request $request){
        $email = htmlspecialchars($request->input('email'));
        $password = htmlspecialchars($request->input('password'));

        $admin = Admin::where('email', $email)->first();
        $barang = Barang::all();

        if ($admin && Hash::check($password, $admin->password)) {
            $request->session()->put('admin', true);
            $request->session()->put('id_admin', $admin->id_admin);
            return redirect('/admin/barang');
            echo "Email atau password salah, Silahkan diulang kembali.";
        }
        else {
            return redirect('/admin/login');
        }
    }

    public function logout(Request $request){
        $request->session()->forget('admin');
        $request->session()->forget('id_admin');
        return redirect('login');
    }

    public function tampilCustomer(){
        $customer = Transaksi::select('user.id_user', 'transaksi.nama', 'user.email', 'transaksi.alamat')
        ->join('user', 'user.id_user', '=', 'transaksi.id_transaksi')
        ->get();
        return view('data_customer', compact('customer'));
    }

    function hapusCustomer(Request $request){
        $id_user = $request->input('id_user');
        $user = User::where('id_user', $id_user)->first();
        if ($user) {
            $user->delete();
            return redirect('/admin/customer');
        }else{
            return redirect('/admin/customer')->with('error', 'Data gagal dihapus.');
        }

    }
}
