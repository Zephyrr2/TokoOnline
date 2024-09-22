<link rel="stylesheet" href="{{asset('css/navbar.css')}}">

<div class="navbar">
    <div class="navbar-header">
        <h3>TokoOnline Menu</h3>
    </div>
    <ul class="navbar-menu">
        <li><a href="{{url('/barang')}}"><i class="fas fa-box"></i> Products</a></li>
        <li><a href="{{url('/cart')}}"><i class="fas fa-shopping-cart"></i> Cart</a></li>
        <li><a href="{{url('/logout')}}"><i class="fas fa-user"></i> Logout</a></li>
    </ul>
</div>
