<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeController
{
    public function index(){
        return view('home');
    }

    public function tampilBarang(){
        $barang = Barang::all();
        return view('barang', compact('barang'));
    }

    public function tampilBarangAdmin(){
        $barang = Barang::all();
        return view('adminBarang', compact('barang'));
    }

    public function Cart(){
        $cart = Cart::join('barang','barang.id_barang','=','cart.id_barang')
        ->get();
        return view('keranjang', compact('cart'));
    }

    function addToCart(Request $request){
        $id_barang = $request->input('id_barang');
        $qty = $request->input('jumlah_barang');

        $cartCheck = Cart::where('id_barang',$id_barang)->first();

        if($cartCheck){
            $cartCheck->jumlah_barang = $cartCheck->jumlah_barang + $qty;
            $cartCheck->save();
        }else{
            $cart = new Cart;
            $cart->id_barang = $id_barang;
            $cart->jumlah_barang = $qty;
            $cart->save();
        }

        return redirect('cart');
    }

    public function updateCart(Request $request)
    {
        $id_cart = $request->input('id_cart');
        $qty = $request->input('jumlah_barang');

        $cart = Cart::where('id_cart',$id_cart)->first();

        if ($cart) {
            $cart->jumlah_barang = $qty;
            $cart->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cart not found.']);
        }
    }

    public function checkoutProcess(){
        $cart = Cart::join('barang','barang.id_barang','=','cart.id_barang')
        ->select('cart.id_barang','barang.harga','barang.nama_barang','cart.jumlah_barang')
        ->get();
        $trans_code = "TRX-" . mt_rand(100000, 999999);
        $subtotal = 0;
        $total = 0;

        foreach($cart as $keranjang){
            $transaction = new Transaksi;
            $transaction->trans_code = $trans_code;
            $transaction->id_barang = $keranjang->id_barang;
            $transaction->jumlah_barang = $keranjang->jumlah_barang;
            $subtotal = $keranjang->total_harga * $keranjang->jumah_barang;
            $total = $total =+ $subtotal;
            $transaction->total_harga = $total;
            $transaction->save();
        }

        Cart::truncate();

        return redirect('order/confirm');
    }

    public function orderConfirm(){
        $trans = Transaksi::select('trans_code','nama_barang','jumlah_barang','harga')
        ->join('barang','barang.id_barang','=','transaksi.id_barang')
        ->orderBy('transaksi.created_at')
        ->get();

        return view('confirmOrder', compact('trans'));
    }

    function prosesTambahBarang(Request $request){
        $nama_barang = $request->input('nama_barang');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');

        $barang = new Barang();

        $barang->nama_barang = $nama_barang;
        $barang->harga = $harga;
        $barang->stok = $stok;
        $barang->deskripsi = $deskripsi;
        $barang->foto = $foto;
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('image/', $request->file('foto')->getClientOriginalName());
            $barang->foto = $request->file('foto')->getClientOriginalName();
        }
        $barang->save();

        if($barang){
            return redirect('adminBarang')->with('success', 'Data berhasil ditambahkan');
        }else{
            return redirect('adminBarang')->with('eror', 'Data gagal ditambahkan');
        }
    }

    public function tambahBarang(){
        return view('tambahBarang');
    }

    function editBarangProcess(Request $request){
        $id_barang = $request->input('id_barang');
        $nama_barang = $request->input('nama_barang');
        $harga = $request->input('harga');
        $stok = $request->input('stok');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');

        $path = public_path() . '/image/';

        $query = Barang::where('id_barang', $id_barang)->first();

        $foto_lama = $query->foto;

        if ($foto) {
            $thumb = $foto->getClientOriginalName();
            File::delete($path . '/' . $foto_lama);
            $foto->move($path, $thumb);
        }

        $query->nama_barang = $nama_barang;
        $query->deskripsi = $deskripsi;
        $query->harga = $harga;
        $query->stok = $stok;
        $query->foto = $foto = $thumb;
        $query->save();

        if($query){
            return redirect('barang');
        }else{
            echo "Barang tidak dapat diubah";
            return redirect('barang');
        }
    }

    public function editBarang($id_barang){
        $barang = Barang::where('id_barang', $id_barang)->first();
        return view('edit_barang', compact('barang'));
    }

    function hapusBarang(Request $request){
        $id_barang = $request->input('id_barang');
        $brg = Barang::where('id_barang', $id_barang)->first();

        $path = public_path() . '/image/';

        $foto_barang = $brg->foto;

        if ($brg) {
            $brg->delete();
            File::delete($path . '/' . $foto_barang);
            return redirect('barang');
        }else{
            echo "Barang tidak ada!!!";
            return redirect('barang');
        }
    }


}
