<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointify</title>
    <link rel="shortcut icon" href="{{ asset('/images/logo_2.0.ico')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css')}}">
</head>
<body>
    <div class="top-section">
        <img src="{{ asset('/images/logo_2.0.png')}}" alt="for edit muna ">
        <div class="nav-links">
            <a href="#section-1">Home</a>
            <a href="#section-2">Features</a>
            <a href="#section-3">Reviews</a>
        </div>
        <div class="login-tab">
            <a href="{{route('Mainfolder.login')}}">Login</a>
        </div>
        <div class="signin-tab">
            <a href="{{route('Mainfolder.signup')}}">Sign Up</a>
        </div>
    </div>

    <div class="section1">
        <section id="section-1">
            <h1>Simplify your Scheduling with <span>Appointify</span></h1>
            <p>Effortless appointment management 
            for businesses and clients alike.</p>
        </section>
    </div>

    <div class="big-pic">
        <img src="{{ asset('/images/pic1.png')}}" alt="Image here">
    </div>

    <div class="button">
        <a href="{{route('Mainfolder.login')}}">GET STARTED NOW</a>
    </div>

    <section id="section-2">
        <div class="middle-section">
            <div class="container">
                <div class="col-1">
                    <h1>Why choose <span> APPOINTIFY </span>?</h1>
                    <div class="card-container">
                        <div class="card">
                            <img src="{{asset('images/pic2.png')}}" alt="">
                            <h1>easy booking</h1>
                            <p>Simple and intuitive booking system</p>
                        </div>
                        <div class="card">
                            <img src="{{asset('images/pic3.png')}}" alt="">
                            <h1>automated reminders</h1>
                            <p>Never miss an appointment with automated notifications</p>
                        </div>
                        <div class="card">
                            <img src="{{asset('images/pic4.png')}}" alt="">
                            <h1>customizable options</h1>
                            <p>Tailor your scheduling to fit your business needs.</p>
                        </div>
                    </div>
                </div>
            </div>
            <section id="section-3">
                <div class="feedback-col">
                        <h1>404 NOT FOUND</h1>
                </div>
            </section>
        </div>
    </section>

    <footer>
        <div class="left-col">
            <p>Copyright @ 2024 . All right Reserved.</p>
        </div>
        <div class="social-media">
            <a href="#">fb</a>
            <a href="#">twitter</a>
            <a href="#">ig</a>
        </div>
    </footer>

    
</body>
</html>