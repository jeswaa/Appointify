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
        <div class="logo"><a href="{{route('Mainfolder.homepage')}}"><img src="{{ asset('/images/logo_2.0.png')}}" alt=""></a></div>
        <h1>Create an Account</h1>

        <form action="{{route('signup.post')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="fullname" id="fullname" placeholder="Fullname..." value="{{ old('fullname') }}">
            @error('fullname')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="text" name="address" id="address" placeholder="Address..." value="{{ old('address') }}">
            @error('address')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number..." value="{{ old('phonenumber') }}">
            @error('phonenumber')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="text" name="gender" id="gender" placeholder="Gender..." value="{{ old('gender') }}">
            @error('gender')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="text" name="email" id="email" placeholder="Email..." value="{{ old('email') }}">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="file" name="uploadimage" id="uploadimage" accept="image/*">
            @error('uploadimage')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="text" name="username" id="username" placeholder="Username..." value="{{ old('username') }}">
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <input type="password" name="password" id="password" placeholder="Password..." oninput="validatePassword()">
            <div id="password-requirements" class="password-requirements">
                <span id="length" class="error-message" style="display:none;">Password must be at least 8 characters.</span>
                <span id="number" class="error-message" style="display:none;">Password must contain at least one number.</span>
                <span id="special" class="error-message" style="display:none;">Password must contain at least one special character.</span>
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit">Submit</button>
        </form>

        @if(session('error'))
            <div class="error-message">
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if(session('success'))
            <div class="success-message">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="lower-part">
            <p>Already have an account?<a href="{{ route('Mainfolder.login')}}"> Log In</a></p>
        </div>
    </div>

    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const lengthMessage = document.getElementById('length');
            const numberMessage = document.getElementById('number');
            const specialMessage = document.getElementById('special');

            // Reset all messages
            lengthMessage.style.display = 'none';
            numberMessage.style.display = 'none';
            specialMessage.style.display = 'none';

            // Validate password length
            if (password.length < 8) {
                lengthMessage.style.display = 'block';
            }

            // Validate for at least one number
            if (!/\d/.test(password)) {
                numberMessage.style.display = 'block';
            }

            // Validate for at least one special character
            if (!/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
                specialMessage.style.display = 'block';
            }
        }
    </script>
</body>
</html>
