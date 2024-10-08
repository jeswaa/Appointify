<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container" animate__slideInRight>
        <div class="logo"><img src="{{ asset('/images/logo.png') }}" alt=""><a href="{{ route('Mainfolder.homepage') }}"><p>Appointify</p></a></div>
        <h1>Hello There!</h1>

        @if(session('error'))
            <div class="error-message" style="display: block;"> <!-- Display the error message if exists -->
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="post">
            @csrf
            <input type="text" name="username" id="username" placeholder="Your username or email..." required>
            <input type="password" name="password" id="password" placeholder="Your password..." required>
            <button>Login</button>
        </form>

        <div class="down-container">
            <p>Don't have an account? <a href="{{ route('Mainfolder.signup') }}">Sign Up</a></p>
        </div>

        <div class="social-login">
            <h2>Or sign up with</h2>
            <a href="{{ route('auth.google') }}" class="google-button">Google</a>
        </div>

    </div>
</body>
</html>
