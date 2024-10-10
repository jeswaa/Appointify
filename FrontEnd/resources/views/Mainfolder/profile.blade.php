<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
    <title>MyProfile</title>
</head>
<body>
    <div class="back-btn">
        <a href="{{route('Mainfolder.userHomepage')}}"><i class="fas fa-arrow-left" style="font-size: 40px;"></i></a>
        <p>PROFILE</p>
        <a href="javascript:void(0)" class="icon" onclick="openSidePanel()">
            <i class="far fa-bell" style="font-size: 40px;"></i>
        </a>
    </div>

    <!-- Notification Sidebar -->
    <div id="notificationPanel" class="side-panel">
        <a href="javascript:void(0)" class="close-btn" onclick="closeSidePanel()">
            <i class="fas fa-times"></i>
        </a>
        <div class="side-panel-content">
            <h2>Appointment Reminders</h2>
            <ul id="notificationList">
                <li>No new notifications...</li>
            </ul>
        </div>
    </div>

    <div class="main-col">
        <!-- Edit profile button only shown on profile page -->
        @if(!isset($isAboutPage))
            <a href="{{route('Mainfolder.editprofile_user')}}" class="icon"><i class="fas fa-pencil-alt"></i></a>
        @endif

        @if($user)
            <div class="profPic">
                <img src="{{ $profileImage }}" alt="Profile Image">
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

    <div class="links-col">
        <a href="{{route('Mainfolder.appointment')}}">Appointments</a>
        <a href="{{route('Mainfolder.about')}}">About</a>
    </div>

    <!-- About section content -->
    @if(isset($isAboutPage) && $isAboutPage)
        <div class="about-col">
            <p><strong>Address:</strong> {{ $user->address }}</p>
            <p><strong>Gender:</strong> {{ $user->gender }}</p>
            <p><strong>Username:</strong> {{ $user->username }}</p>
        </div>
    @endif

    <div class="appointment-col">
    @if(isset($isAppointmentPage) && $isAppointmentPage)
        @if($appointments && count($appointments) > 0)
            @foreach($appointments as $appointment)
                <div class="date-col">
                    <div class="month">{{ \Carbon\Carbon::parse($appointment->date)->format('F') }}</div>
                    <div class="day">{{ \Carbon\Carbon::parse($appointment->date)->format('d') }}</div>
                    <div class="year">{{ \Carbon\Carbon::parse($appointment->date)->format('Y') }}</div>
                </div>
                <div class="time-col">
                    <strong>Time</strong>
                    <div class="time">{{ $appointment->session_time }}<br></div>
                </div>
                <strong>Service:</strong> {{ $appointment->service }}<br>
            @endforeach
        @else
            <p>No appointments found.</p>
        @endif
</div>


@endif
    </div>

    <script>
        function openSidePanel() {
            document.getElementById("notificationPanel").classList.add("open-side-panel");
        }

        function closeSidePanel() {
            document.getElementById("notificationPanel").classList.remove("open-side-panel");
        }

        // Example of how to dynamically add notifications to the list
        function addNotification(message) {
            const notificationList = document.getElementById('notificationList');
            const newNotification = document.createElement('li');
            newNotification.textContent = message;
            notificationList.appendChild(newNotification);
        }
    </script>
</body>
</html>
