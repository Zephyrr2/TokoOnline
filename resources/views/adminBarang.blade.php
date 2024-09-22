<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="{{ asset('css/barang.css') }}">
</head>
<body>
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">

    <div class="navbar">
        <div class="navbar-header">
            <h3>TokoOnline Menu</h3>
        </div>
        <ul class="navbar-menu">
            <li><a href="{{ url('/barang/tambah') }}"><i class="fas fa-home"></i>Tambah Barang</a></li>
            <li><a href="{{url('/logout')}}"><i class="fas fa-user"></i> Logout</a></li>
        </ul>
    </div>
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
                        <a href="{{url('barang/edit/' . $brg->id_barang)}}" class="btn btn-edit">Edit</a>
                        <form action="{{url('barang/delete')}}" method="post">
                            @method('delete')
                            @csrf
                            <input type="hidden" name="barang_id" value="{{$brg->id_barang}}">
                            <button type="submit" class="btn btn-delete">Hapus</button>
                        </form>
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
