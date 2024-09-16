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
        <a href="#"><i class="fas fa-angle-left"></i></a>
        <h1>Book Appoinment</h1>
        </div>
    <form action="#" method="post">
        <div class="first-col">
            <h1>Information</h1>
            <input type="text" name="fullname" id="fullname" placeholder="Fullname...">
            <input type="text" name="address" id="address" placeholder="Address...">
            <input type="text" name="phonenumber" id="phonenumber" placeholder="Phone Number...">
            <input type="text" name="email" id="email" placeholder="Email...">
        </div>
        <div class="second-col">
            <h1>Select Slot</h1>
            <label for="options">Time</label>
                <select id="options" name="options" placeholder="Choose Time">
                    <option value="" selected disabled>Select a time</option>
                    <option value="option1">Option 1</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
                <div class="another-part-date">
                    <label for="date">Date</label>
                    <input type="date">
                </div>
                <div class="another-part-reason">
                    <label for="reason">Reason of visit</label>
                    <input type="text">
                </div>
                    
                
        </div>
        <div class="third-col">
        <h1>Choose Clinic</h1>
                <select id="options" name="options">
                <option value="" selected disabled>Choose Clinic</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
        </div>
        <div class="fourth-col">
                    <h1>Payment Method</h1>
                    <!-- Radio buttons for payment method -->
                    <input type="radio" id="onsite" name="payment-method" value="onsite" onclick="toggleOnlinePayment(this)">
                    <label for="onsite">Onsite Payment</label><br>

                    <input type="radio" id="online" name="payment-method" value="online" onclick="toggleOnlinePayment(this)">
                    <label for="online">Online Payment</label><br>

                    <!-- Dropdown for online payment methods (initially hidden) -->
                        <div id="online-payment-options" style="display: none; margin-top: 50px; margin-left: 3px; background-color: transparent;">
                            <label for="online-payment">Choose Payment Method</label>
                            <select id="online-payment" name="online-payment">
                                <option value="paypal">PayPal</option>
                                <option value="gcash">GCash</option>
                                <option value="visa">Visa</option>
                            </select>
                        </div>
                </div>

                <script>
                    function toggleOnlinePayment(element) {
                        var onlinePaymentDiv = document.getElementById("online-payment-options");
                        if (element.value === "online") {
                            onlinePaymentDiv.style.display = "block";
                        } else {
                            onlinePaymentDiv.style.display = "none";
                        }
                    }
                </script>



        <button>Book Now</button>

    </form>
</body>
</html>