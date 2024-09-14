<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="{{ asset('assets/css/forbooking.css')}}">
</head>
<body>
    <h1>Book Appoinment</h1>
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
                <select id="options" name="options">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
                <label for="date">Date</label>
                <input type="date">
                <label for="reason">Reason of visit</label>
                <input type="text">
        </div>
        <div class="third-col">
        <h1>Choose Clinic</h1>
            <label for="options">Choose Clinic</label>
                <select id="options" name="options">
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                    <option value="option3">Option 3</option>
                </select>
        </div>
        <div class="fourth-col">
                    <h1>Payment Method</h1>
                    <label for="payment-method">Choose Payment Method:</label><br>

                    <!-- Radio buttons for payment method -->
                    <input type="radio" id="onsite" name="payment-method" value="onsite" onclick="toggleOnlinePayment(this)">
                    <label for="onsite">Onsite Payment</label><br>

                    <input type="radio" id="online" name="payment-method" value="online" onclick="toggleOnlinePayment(this)">
                    <label for="online">Online Payment</label><br>

                    <!-- Dropdown for online payment methods (initially hidden) -->
                    <div id="online-payment-options" style="display: none; margin-top: 10px;">
                        <label for="online-payment">Choose Online Payment Method:</label>
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