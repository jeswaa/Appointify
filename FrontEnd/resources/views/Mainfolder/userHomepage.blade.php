<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointify</title>
    <link rel="shortcut icon" href="{{ asset('/images/logo_2.0.ico')}}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/userhomepage.css') }}">
    <style>
        .star {
            font-size: 30px;
            color: gray;
            cursor: pointer;
        }
        .star.selected {
            color: gold;
        }
    </style>
</head>
<body>
    <div class="top-section">
        <img src="{{ asset('/images/logo_2.0.png') }}" alt="for edit muna ">
        <div class="nav-links">
            <a href="#section-1">Home</a>
            <a href="#section-2">Features</a>
            <a href="#section-3">Reviews</a>
        </div>
        <div class="user-prof">
            <a href="{{ route('Mainfolder.profile') }}"><i class="far fa-user-circle"></i></a>
        </div>
    </div>

    <div class="section1">
        <section id="section-1">
            <h1>Simplify your Scheduling with <span>Appointify</span></h1>
            <p>Effortless appointment management for businesses and clients alike.</p>
        </section>
    </div>

    <div class="big-pic">
        <img src="{{ asset('/images/pic1.png') }}" alt="Image here">
    </div>

    <!-- Button to trigger modal -->
    <div class="button">
        <a href="#" id="bookNowButton">BOOK NOW!</a>
    </div>

    <section id="section-2">
        <div class="middle-section">
            <div class="container">
                <div class="col-1">
                    <h1>Why choose <span>APPOINTIFY</span>?</h1>
                    <div class="card-container">
                        <div class="card">
                            <img src="{{ asset('images/pic2.png') }}" alt="">
                            <h1>Easy Booking</h1>
                            <p>Simple and intuitive booking system</p>
                        </div>
                        <div class="card">
                            <img src="{{ asset('images/pic3.png') }}" alt="">
                            <h1>Automated Reminders</h1>
                            <p>Never miss an appointment with automated notifications</p>
                        </div>
                        <div class="card">
                            <img src="{{ asset('images/pic4.png') }}" alt="">
                            <h1>Customizable Options</h1>
                            <p>Tailor your scheduling to fit your business needs.</p>
                        </div>
                    </div>
                </div>
            </div>

            <section id="section-3">
                <div class="feedback-col">
                @if (isset($feedbacks) && !$feedbacks->isEmpty())
                    <section id="section-3">
                        <div class="feedback-col">
                            <h2>Feedbacks</h2>
                            <ul>
                                @foreach ($feedbacks as $feedback)
                                    <li>
                                        <strong>Rating:</strong> {{ $feedback->star }}
                                        <br>
                                        <strong>Message:</strong> {{ $feedback->feedback_message }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                @endif
                </div>
            </section>

        </div>
    </section>

    <footer>
        <div class="left-col">
            <p>Copyright © 2024. All rights reserved.</p>
        </div>
        <div class="social-media">
            <a href="#">fb</a>
            <a href="#">twitter</a>
            <a href="#">ig</a>
        </div>
    </footer>

    <!-- Feedback Modal -->
<div class="overlay" id="overlay"></div>
<div class="modal" id="feedbackModal">
    <img src="{{ asset('/images/logo_2.0.png') }}" alt="for edit muna ">
    <div class="modal-header">
        <h5>Help us Improve</h5>
        <button id="closeModal"><i class="fas fa-times"></i></button>
    </div>

    <!-- Feedback Form -->
    <form action="{{ route('addFeedback') }}" method="POST">
        @csrf
            <div class="modal-body">
                <div id="star-container">
                    <span class="star" data-value="1">&#9733;</span>
                    <span class="star" data-value="2">&#9733;</span>
                    <span class="star" data-value="3">&#9733;</span>
                    <span class="star" data-value="4">&#9733;</span>
                    <span class="star" data-value="5">&#9733;</span>
                </div>

                <!-- Hidden input to store selected star rating -->
                <input type="hidden" id="starRating" name="star" value="">

                <p>What do you think of our tool?</p>
                <textarea id="feedbackText" name="feedback_message" rows="3" placeholder="Write your feedback..."></textarea>
            </div>

            <div class="submitbtn">
                <button type="submit" id="submitFeedback">Submit</button>
            </div>
        </form>
    </div>


    <script>
        const bookNowButton = document.getElementById('bookNowButton');
        const feedbackModal = document.getElementById('feedbackModal');
        const overlay = document.getElementById('overlay');
        const closeModal = document.getElementById('closeModal');
        const stars = document.querySelectorAll('.star');
        const submitFeedback = document.getElementById('submitFeedback');
        const starRatingInput = document.getElementById('starRating'); // Reference to hidden input
        let selectedRating = 0;

        // Show the feedback modal
        bookNowButton.addEventListener('click', () => {
            feedbackModal.style.display = 'block';
            overlay.style.display = 'block';
        });

        // Close modal and redirect to booking page
        closeModal.addEventListener('click', () => {
            closeFeedbackModal();
            redirectToBooking();
        });

        // Close modal when clicking outside of it and redirect
        overlay.addEventListener('click', () => {
            closeFeedbackModal();
            redirectToBooking();
        });

        // Submit feedback (form submission handled automatically)
        submitFeedback.addEventListener('click', (event) => {
            // Prevent the default form submission to allow manual processing
            event.preventDefault();
            
            if (selectedRating === 0) {
                alert('Please select a rating before submitting your feedback.');
                return;
            }

            // Optionally show a thank you message or do other processing here
            // For now, let's submit the form directly
            document.querySelector('form').submit(); // Submit the form programmatically
        });

        // Function to close the modal
        function closeFeedbackModal() {
            feedbackModal.style.display = 'none';
            overlay.style.display = 'none';
        }

        // Update star selection based on the user's rating
        stars.forEach(star => {
            star.addEventListener('click', () => {
                selectedRating = star.getAttribute('data-value');
                updateStars(selectedRating);
                starRatingInput.value = selectedRating; // Update hidden input with selected rating
            });
        });

        // Highlight stars based on the selected rating
        function updateStars(rating) {
            stars.forEach(star => {
                star.classList.toggle('selected', star.getAttribute('data-value') <= rating);
            });
        }

        // Redirect to the booking page
        function redirectToBooking() {
            window.location.href = '{{ route("Mainfolder.BookingPage") }}';
        }
    </script>

</body>
</html>
