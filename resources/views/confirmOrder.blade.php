<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pesanan</title>
    <link rel="stylesheet" href="{{asset('css/formorder.css')}}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Konfirmasi Pesanan</h1>
        </div>
        <form action="{{ url('/checkout/process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" required></textarea>
            </div>
            <div class="order-summary">
                <h2>Ringkasan Pesanan</h2>
                <p>Detail Pesanan Anda:</p>
                @php
                $subtotal = 0;
                $total = 0;
                @endphp
                @foreach ($trans as $transaction)
                <div class="order-item">
                    <p>{{$transaction->nama_barang}} (x{{$transaction->jumlah_barang}})</p>
                    @php
                        $subtotal = $transaction->harga * $transaction->jumlah_barang;
                        $total += $subtotal;
                    @endphp
                </div>
                <hr>
                @endforeach
                <div class="total">
                    <h4>Total Pesanan: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                </div>
                <button type="submit" class="submit-btn">Buat Pesanan</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/91500c2459.js" crossorigin="anonymous"></script>
</body>
</html>
