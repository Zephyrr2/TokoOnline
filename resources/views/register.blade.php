<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="{{asset('css/formlogin.css')}}">
</head>
<body>
    <div class="register-container">
        <h2>Signup</h2>
        <form action="{{ url('register/process') }}" method="POST">
            @csrf
            <label for="name">Username</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>