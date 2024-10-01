<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="{{asset('css/formlogin.css')}}">
</head>
<body>
    <div class="register-container">
        <h2>Signin</h2>
        <form action="{{ url('login/process') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Signin</button>
        </form>
        <p class="register-link">don't have an account? <a href="{{ url('register') }}">Signup</a></p>
    </div>
</body>
</html>
