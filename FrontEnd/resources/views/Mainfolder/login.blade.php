<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container" animate__slideInRight>
        <div class="logo"><img src="{{ asset('/images/logo.png') }}" alt=""><a href="{{ route('Mainfolder.homepage') }}"><p>Appointify</p></a></div>
        <h1>Hello There!</h1>
        <div class="adminIcon">
            <a href="#" class="tooltip" id="adminIcon">
                <i class="fas fa-user-cog"></i>
                <span class="tooltiptext">Admin Only</span>
            </a>
        </div>

        @if(session('error'))
            <div class="error-message" style="display: block;"> 
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="post" id="loginForm">
            @csrf
            <input type="text" name="username" id="username" placeholder="Your username or email..." required>
            <input type="password" name="password" id="password" placeholder="Your password..." required>
            <button type="submit">Login</button>
        </form>

        <div class="down-container">
            <p>Don't have an account? <a href="{{ route('Mainfolder.signup') }}">Sign Up</a></p>
        </div>

        <div class="social-login">
            <h2>Or sign up with</h2>
            <a href="{{ route('auth.google') }}" class="google-button">Google</a>
        </div>

    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Admin Login</h2>
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <input type="text" name="username" id="modalUsername" placeholder="Username...." required>
                <input type="password" name="password" id="modalPassword" placeholder="Password...." required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the admin icon
        var adminIcon = document.getElementById("adminIcon");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the icon, open the modal 
        adminIcon.onclick = function(event) {
            event.preventDefault(); // Prevent default anchor behavior
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
