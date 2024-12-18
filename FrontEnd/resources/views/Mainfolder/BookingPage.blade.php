<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/forbooking.css')}}">
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</head>
<body>
        <div class="header-container">
        <a href="{{route('Mainfolder.userHomepage')}}"><i class="fas fa-angle-left"></i></a>
        <h1>Book Appoinment</h1>
        </div>
    <form action="{{route('booking.post')}}" method="POST">
        @csrf
            <div class="first-col">
                <h1>Information</h1>
                <hr>
                <input type="text" name="fullname" id="fullname" placeholder="Fullname..."  value="{{ $user->fullname ?? '' }}">
                <input type="text" name="address" id="address" placeholder="Address..." value="{{ $user->address ?? '' }}">
                <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number..." value="{{ $user->phonenumber ?? '' }}">
                <input type="text" name="email" id="email" placeholder="Email..." value="{{ $user->email ?? '' }}">
            </div>

            <div class="date">
                <h1>Date</h1>
                <input type="date" name="date" id="date">
            </div>
            <div class="second-col">
                    <h1 class="title">Time</h1>
                        <hr class="divider">
                        <div class="session">
                            <h2 class="session-title">MORNING SESSION</h2>
                            <div class="session-times">
                                <input type="radio" id="session1" name="afternoon-session" value="8:00 - 9:00 AM">
                                <label for="session1" class="time">8:00 - 9:00 AM</label>
                                
                                <input type="radio" id="session2" name="afternoon-session" value="9:30 - 10:30 AM">
                                <label for="session2" class="time">9:30 - 10:30 AM</label>
                                
                                <input type="radio" id="session3" name="afternoon-session" value="11:00 - 12:00 AM">
                                <label for="session3" class="time highlight">11:00 - 12:00 AM</label>
                            </div>
                        </div>
                        <div class="session">
                            <h2 class="session-title">AFTERNOON SESSION</h2>
                            <div class="session-times">
                                <input type="radio" id="session4" name="afternoon-session" value="1:00 - 2:00 PM">
                                <label for="session4" class="time">1:00 - 2:00 PM</label>

                                <input type="radio" id="session5" name="afternoon-session" value="2:30 - 3:30 PM">
                                <label for="session5" class="time">2:30 - 3:30 PM</label>

                                <input type="radio" id="session6" name="afternoon-session" value="4:00 - 5:00 PM">
                                <label for="session6" class="time highlight">4:00 - 5:00 PM</label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="third-col">
        <div class="heading">
            <h2>Payment</h2>
            <p>Choose Payment method below.</p>
        </div>
            <div class="title">
                <h2>Onsite Payment</h2>
                <input type="radio" id="onsite" name="payment" value="onsite"> <!-- All radio buttons share the same 'name' -->
                <label for="onsite" class="onsite">Pay Onsite</label>
            </div>
            <div class="title">
                <h2 class="online">Online Payment</h2>
                <input type="radio" id="paypal" name="payment" value="paypal">
                <label for="paypal" class="ol">
                    <div class="img-paypal">
                        <img src="{{ asset('/images/paypal.png') }}" alt="PayPal">
                    </div>
                </label>

                <input type="radio" id="gcash" name="payment" value="g-cash">
                <label for="gcash" class="ol">
                    <div class="img-gcash">
                        <img src="{{ asset('/images/gcash.png') }}" alt="G-Cash">
                    </div>
                </label>
            </div>
            <button id="bookBtn">Book</button>
        </div> 
    </form>

     
</body>
</html>