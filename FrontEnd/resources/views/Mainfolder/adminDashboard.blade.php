<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="side-col">
        <img src="{{ asset('/images/logo.png') }}" alt="logo">
        <a href=""><i class="fas fa-tachometer-alt"></i><span>dashboard</span></a>
        <a href=""><i class="far fa-calendar-check"></i><span>appointments</span></a>
        <a href=""><i class="fas fa-user"></i><span>users</span></a>
        <a href=""><i class="fas fa-comment-dots"></i><span>reviews</span></a>
        <div class="logoutbtn">
            <a href=""><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>
</body>
</html>