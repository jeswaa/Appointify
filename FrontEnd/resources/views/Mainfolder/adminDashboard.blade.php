<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" 
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" 
            crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" 
          rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="side-col">
        <img src="{{ asset('/images/logo.png') }}" alt="logo">
        <a href="#"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
        <a href="{{ route('Mainfolder.adminAppointment') }}">
            <i class="far fa-calendar-check"></i><span>Appointments</span>
        </a>
        <a href="#"><i class="fas fa-user"></i><span>Users</span></a>
        <a href="#"><i class="fas fa-comment-dots"></i><span>Reviews</span></a>
        <div class="logoutbtn">
            <a href="#"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

    @if(isset($admin))
        <div class="main-col">
            <div class="profile-sec">

            </div>
            <div class="first-col">
                <img src="{{ asset('/images/AdminWelcome.png') }}" alt="">
                <h1>Hello, <span>{{ $admin->fullname }}</span>!</h1>
                <p>Welcome back to Appointify</p>
            </div>

            <div class="second-col">
                <div class="card">
                    <h1>Appointment</h1>
                    <i class="far fa-calendar-check" style="color: #4A4A4A; position: absolute; right: 20px; top: 20px; font-size: 30px;"></i>
                </div>
                <div class="card">
                    <h1>Users</h1>
                    <i class="far fa-user" style="color: #4A4A4A; position: absolute; right: 30px; top: 20px; font-size: 30px;"></i>
                </div>
                <div class="card">
                    <h1>New Users</h1>
                    <i class="far fa-user" style="color: #4A4A4A; position: absolute; right: 20px; top: 20px; font-size: 30px;"></i>
                </div>
            </div>



            <div class="review-sec">
                <h1>Reviews</h1>
            </div>
        </div>
    @else
        <h1>Admin data not found!</h1>
    @endif
</body>
</html>
