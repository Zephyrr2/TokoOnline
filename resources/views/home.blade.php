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