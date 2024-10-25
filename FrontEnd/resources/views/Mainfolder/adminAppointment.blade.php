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
        <a href="{{ route('Mainfolder.adminDashboard')}}"><i class="fas fa-tachometer-alt"></i><span>dashboard</span></a>
        <a href="{{route('Mainfolder.adminAppointment')}}"><i class="far fa-calendar-check"></i><span>appointments</span></a>
        <a href=""><i class="fas fa-user"></i><span>users</span></a>
        <a href=""><i class="fas fa-comment-dots"></i><span>reviews</span></a>
        <div class="logoutbtn">
            <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a>
        </div>
    </div>

    <div class="appointment-col">
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Fullname</th>
                        <th>Address</th>
                        <th>Phonenumber</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Payment</th> 
                        <th>Send Reminder</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->fullname }}</td>
                            <td>{{ $appointment->address }}</td>
                            <td>{{ $appointment->phonenumber }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->date}}</td>
                            <td>{{ $appointment->session_time}}</td>
                            <td>{{ $appointment->payment_method}}</td>
                            <td>
                                <form action="{{ route('send.reminder', $appointment->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Send Reminder</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if(session('success'))
    <div class="alert alert-success top-right-alert">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger top-right-alert">{{ session('error') }}</div>
    @endif

    <script>
    window.onload = function() {
        const alertBox = document.querySelector('.top-right-alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.add('fade-out'); // Add fade-out class after a delay
            }, 1000); // Display for 3 seconds before starting the fade-out
        }
    };
</script>

</body>
</html>