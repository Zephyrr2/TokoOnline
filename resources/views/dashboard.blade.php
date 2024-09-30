<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Barang</title>
    <link rel="stylesheet" href="{{ asset('css/barang.css') }}">
</head>
<body>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>TokoOnline Menu</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ url ('/admin/barang')}}"><i class="fas fa-plus"></i>Barang</a></li>
            <li><a href="{{ url('/barang/tambah') }}"><i class="fas fa-plus"></i>Tambah Barang</a></li>
            <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
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
                    <a href="{{url('barang/edit/' . $brg->id_barang)}}" class="btn btn-edit">Edit</a>
                    <form action="{{url('barang/delete')}}" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="id_barang" value="{{$brg->id_barang}}">
                        <button type="submit" class="btn btn-delete">Hapus</button>
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
