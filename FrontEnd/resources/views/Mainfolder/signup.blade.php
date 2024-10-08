<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('assets/css/signup.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="logo"><a href="{{route('Mainfolder.homepage')}}"><p>Appointify</p></a><img src="{{ asset('/images/logo.png')}}" alt=""></div>
        <h1>Create an Account</h1>

        <form action="{{route('signup.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="fullname" id="fullname" placeholder="Fullname...">
            <input type="text" name="address" id="address" placeholder="Address...">
            <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number...">
            <input type="text" name="gender" id="gender" placeholder="Gender...">
            <input type="text" name="email" id="email" placeholder="Email...">
            <input type="file" name="uploadimage" id="uploadimage" accept="image/*" placeholder="Upload Image...">
            <input type="text" name="username" id="username" placeholder="Username...">
            <input type="password" name="password" id="password" placeholder="Password...">
            <button>Submit</button>
        </form>
        
        @if(session('error'))
            <div class="error-message">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        <div class="social-login">
            <h2>Or sign up with</h2>
            <a href="{{ route('auth.google') }}" class="google-button">Google</a>
        </div>

        <div class="lower-part">
            <p>Already have an account?<a href="{{ route('Mainfolder.login')}}"> Log In</a></p>
        </div>
    </div>
</body>
</html>
