<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo"><img src="{{ asset('/images/logo.png')}}" alt=""><p>Appointify</p></div>
        <h1>Hello There!</h1>

        <form action="#" method="post">
            <input type="text" name="username" id="username" placeholder="Your username...">
            <input type="text" name="password" id="password" placeholder="Your password...">
            <button>Login</button>
        </form>
        <div class="down-container">
            <p>Don't have an account?<a href="#"> Sign Up</a></p>
        </div>
    </div>
</body>
</html>