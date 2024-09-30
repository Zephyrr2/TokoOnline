<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link rel="stylesheet" href="{{asset('css/table.css')}}">

    <div class="sidebar">
        <div class="sidebar-header">
            <h3>TokoOnline Menu</h3>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ url ('/admin/barang')}}"><i class="fas fa-plus"></i>Barang</a></li>
            <li><a href="{{ url('/admin/customer') }}"><i class="fas fa-plus"></i>Data Customer</a></li>
            <li><a href="{{ url('/barang/tambah') }}"><i class="fas fa-plus"></i>Tambah Barang</a></li>
            <li><a href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="content-wrapper">
        <h2>Data Customer</h2>
        <table class="customer-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer as $cstmr)
                <tr>
                    <td>{{ $cstmr->id_user }}</td>
                    <td>{{ $cstmr->nama }}</td>
                    <td>{{ $cstmr->email }}</td>
                    <td>{{ $cstmr->alamat }}</td>
                    <td>
                        <form action="{{url('customer/delete')}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="id_user" value="{{$cstmr->id_user}}">
                            <button type="submit" class="delete-btn">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
