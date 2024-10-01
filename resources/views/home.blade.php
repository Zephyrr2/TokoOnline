<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }
.home {
    background-color: #f4f4f4;
    padding: 40px 0;
    text-align: center;
}

.home-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.home-title {
    font-size: 32px;
    color: #333;
    margin: 0;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
}

</style>

<link rel="stylesheet" href="{{asset('css/navbar.css')}}">
<link rel="stylesheet" href="{{asset('css/barang.css')}}">

<div class="navbar">
    <div class="navbar-header">
        <h3>TokoOnline Menu</h3>
    </div>
    <ul class="navbar-menu">
        <li><a href="{{url('/')}}"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="{{url('/login')}}"><i class="fas fa-sign-in-alt"></i> Signin</a></li>
        <li><a href="{{url('/register')}}"><i class="fas fa-user-plus"></i> Signup</a></li>
    </ul>
</div>

<div class="home">
    <div class="home-container">
        <h2 class="home-title">Selamat Datang di Toko Online</h2>
    </div>
</div>

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
