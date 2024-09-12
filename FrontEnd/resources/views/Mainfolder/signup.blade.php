<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo"><a href="{{route('Mainfolder.homepage')}}"><p>Appointify</p></a><img src="{{ asset('/images/logo.png')}}" alt=""></div>
        <h1>Create an Account</h1>

        <form action="#" method="post">
            @csrf
            <input type="text" name="fullname" id="fullname" placeholder="Fullname...">
            <input type="text" name="address" id="address" placeholder="Address...">
            <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number...">
            <input type="text" name="gender" id="gender" placeholder="Gender...">
            <input type="text" name="email" id="email" placeholder="Email...">
            <input type="text" name="uploadimage" id="uploadimage" placeholder="Upload Image...">
            <input type="text" name="username" id="username" placeholder="Username...">
            <input type="text" name="password" id="password" placeholder="Password...">
            <button>Submit</button>
        </form>
        <div class="lower-part">
            <p>Alread have an account?<a href="{{ route('Mainfolder.login')}}">Log In</a></p>
        </div>
    </div>
</body>
</html>