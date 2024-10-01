<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="{{ asset('css/keranjang.css') }}">
</head>
<body>
    @include('navbar')
    <div class="container">
        <h2 class="page-title">Keranjang Belanja</h2>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Foto Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $total = 0;
                @endphp
                @forelse ($cart as $item)
                <tr class="cart-item">
                    <td><img src="{{asset('image/' . $item->foto)}}" alt="{{$item->nama_barang}}" class="product-image"></td>
                    <td class="product-name">{{$item->nama_barang}}</td>
                    <td class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                        <input type="number" name="jumlah_barang" value="{{ $item->jumlah_barang }}" class="quantity-input" onkeyup="updateQty({{ $item->id_cart }}, this.value)">
                    </td>
                    <td class="subtotal">Rp {{ number_format($item->harga * $item->jumlah_barang, 0, ',', '.') }}</td>
                </tr>
                @php
                    $total += $item->harga * $item->jumlah_barang;
                @endphp
                @empty
                <tr>
                    <td colspan="5" class="empty-cart">Tidak ada barang di keranjang anda</td>
                </tr>
                @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4" class="total-label">Total</th>
                    <th class="total-amount">Rp {{ number_format($total, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
        <div class="action-buttons">
            @if ($isLoggedIn == true)
            <form action="{{url('/order/confirm')}}" method="get" class="checkout-form">
                @csrf
                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
            @else
            <a href="{{url('/login')}}" class="btn btn-primary">Login untuk Checkout</a>
            @endif
            <a href="{{url('/barang')}}" class="btn btn-secondary">Lanjut Belanja</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        function updateQty(id, qty) {
            $.ajax({
                url: "{{url('cart/update')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_cart": id,
                    "jumlah_barang": qty
                },
                success: function(data) {
                    if(data.success) {
                        location.reload();
                        console.log('berhasil');
                    } else {
                        alert('Gagal mengupdate jumlah barang.');
                    }
                }
            });
        }
    </script>
</body>
</html>
