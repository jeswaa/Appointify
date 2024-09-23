<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css')}}">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <title>MyProfile</title>
</head>
<body>
    <div class="back-btn">
        <a href="{{route('Mainfolder.userHomepage')}}"><i class="fas fa-arrow-left" style="font-size: 40px;"></i></a><p>PROFILE</p> 
        <a href="" class=" icon"><i class="far fa-bell"  style="font-size: 40px;"></i></a>
    </div>
    <div class="main-col">
        <a href="" class="icon"><i class="fas fa-pencil-alt"></i></a>
    @if($user)
        <div class="profPic">
            <img src="{{ asset('storage/'  . $user->uploadimage) }}" alt="Profile Picture" />
        </div>
        <div class="info">
            <h1>WELCOME BACK,</h1>
            <h2>{{ $user->fullname }}</h2>
            <p>{{$user->email}} | <span>{{$user->phonenumber}}</span></p>
        </div>
        
    @else
        <p>User not found.</p>
    @endif

    </div>
</body>
</html>