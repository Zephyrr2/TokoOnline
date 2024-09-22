<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="{{asset('css/formorder.css')}}">
</head>
<body>
    <div class="container">
        <h2>Edit {{$barang->nama_barang}}</h2>
        <form action="{{url('barang/edit/proses/')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="barang_id" value="{{$barang->id_barang}}">
            <div class="form-group">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" name="nama_barang" value="{{$barang->nama_barang}}">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" rows="10">{{$barang->deskripsi}}</textarea>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" name="harga" value="{{$barang->harga}}">
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" name="stok" value="{{$barang->stok}}">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" name="foto" value="{{$barang->foto}}">
            </div>
            <button type="submit" class="submit-btn">Simpan</button>
        </div>
    </form>
</body>
</html>