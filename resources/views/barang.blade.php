<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="{{ asset('css/barang.css') }}">
</head>
<body>
    @include('navbar')
    @forelse($barang as $brg)
    <div class="container">
        <div class="card">
            <img class="card-img" src="{{ asset('image/' . $brg->foto) }}" alt="{{ $brg->nama_barang }}">
            <div class="card-body">
                <h5 class="card-tittle">{{$brg->nama_barang}}</h5>
                <p class="card-text">{{$brg->deskripsi}}</p>
                <p class="card-text">{{$brg->harga}}</p>
                <div class="button-container">
                    <a href="#" class="btn btn-detail">Detail</a>
                        <form action="{{url('cart/process')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{$brg->id_barang}}">
                            <input type="hidden" name="jumlah_barang" value="1">
                            <button type="submit" class="btn btn-edit">Tambah Ke Keranjang</button>
                         </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="no-products">
        <p>Barang tidak ditemukan.</p>
    </div>
    @endforelse
</body>
</html>
