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
    <div class="container">
        <div class="product-list">
            @forelse($barang as $brg)
            <div class="product-item">
                <div class="product-card">
                    <img class="product-image" src="{{ asset('image/' . $brg->foto) }}" alt="{{ $brg->nama_barang }}">
                    <h5 class="product-name">{{$brg->nama_barang}}</h5>
                    <p class="product-description">{{$brg->deskripsi}}</p>
                    <p class="product-price">{{$brg->harga}}</p>
                    <div class="product-actions">
                        <a href="#" class="btn btn-detail">Detail</a>
                        <form action="{{url('cart/process')}}" method="POST" class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="id_barang" value="{{$brg->id_barang}}">
                            <input type="hidden" name="jumlah_barang" value="1">
                            <button type="submit" class="btn btn-add-to-cart">Tambah Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="no-products">
                <p>Barang tidak ditemukan.</p>
            </div>
            @endforelse
        </div>
    </div>
</body>
</html>
