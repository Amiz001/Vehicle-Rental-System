<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedAddOns = json_decode($_POST['selected_addons'], true);
    $totalPrice = $_POST['total_price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./styles/tailwindcss-colors.css">
    <link rel="stylesheet" href="./styles/payment-style.css">
    <title>Vehicle Rental Payment</title>
</head>
<body>
<?php include ('includes/header.php')?><br><br>
    <!-- start: Payment -->
    <section class="payment-section">
        <div class="container">
            <div class="payment-wrapper">
                <div class="payment-left">
                    <div class="payment-header">
                        <div class="payment-header-icon"><i class="ri-car-fill"></i></div>
                        <div class="payment-header-title">Booking Summary</div>
                        <p class="payment-header-description">Please review and confirm your rental details below to complete your booking securely.</p>
                    </div>
                    <div class="payment-content">
                        <div class="payment-body">
                            <div class="payment-plan">
                                <!--<div class="payment-plan-type">SUV Rental</div>-->
                                <div class="payment-plan-info">
                                    <div class="payment-plan-info-name">Cost of your vehicle</div>
                                    <div class="payment-plan-info-price">LKR 20,000 per day</div>
                                </div>
                                <a href="#" class="payment-plan-change">Change Vehicle</a>
                            </div>
                            <div class="payment-summary">
                                <div class="payment-summary-item">
                                    <div class="payment-summary-name">Rental Duration</div>
                                    <div class="payment-summary-price">2 Days</div>
                                </div>
                                <?php
                                    foreach ($selectedAddOns as $addOn) {
                                                echo "<div class='payment-summary-item'>";
                                                echo "<div class='payment-summary-name'>{$addOn['name']}</div>";
                                                echo "<div class='payment-summary-price'>LKR {$addOn['price']} per day</div>";
                                                echo "</div>";
                                    }   
                                     echo "<div class='payment-summary-item'>";
                                     echo "<div class='payment-summary-name'>Total Adons Price</div>";
                                     echo "<div class='payment-summary-price'>LKR {$totalPrice} per day</div>";
                                     echo "</div>";

                                ?>
                                
                                <div class="payment-summary-divider"></div>
                                <div class="payment-summary-item payment-summary-total">
                                    <div class="payment-summary-name">Total</div>
                                    <div class="payment-summary-price">LKR 43,600</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form action="" class="payment-form">
                        <h1 class="payment-title">Payment Details</h1>
                        <div class="payment-method">
                            <input type="radio" name="payment-method" id="method-1" checked>
                            <label for="method-1" class="payment-method-item">
                                <img src="images/visa.png" alt="Visa">
                            </label>
                            <input type="radio" name="payment-method" id="method-2">
                            <label for="method-2" class="payment-method-item">
                                <img src="images/mastercard.png" alt="MasterCard">
                            </label>
                            <input type="radio" name="payment-method" id="method-3">
                            <label for="method-3" class="payment-method-item">
                                <img src="images/paypal.png" alt="PayPal">
                            </label>
                            <input type="radio" name="payment-method" id="method-4">
                            <label for="method-4" class="payment-method-item">
                                <img src="images/stripe.png" alt="Stripe">
                            </label>
                        </div>
                        <div class="payment-form-group">
                            <input type="email" placeholder=" " class="payment-form-control" id="email" required>
                            <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" placeholder=" " class="payment-form-control" id="card-number" required>
                            <label for="card-number" class="payment-form-label payment-form-label-required">Card Number</label>
                        </div>
                        <div class="payment-form-group-flex">
                            <div class="payment-form-group">
                                <input type="date" placeholder=" " class="payment-form-control" id="expiry-date"required>
                                <label for="expiry-date" class="payment-form-label payment-form-label-required">Expiry Date</label>
                            </div>
                            <div class="payment-form-group">
                                <input type="text" placeholder=" " class="payment-form-control" id="cvv" required>
                                <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                            </div>
                        </div>
                        <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

     <script>
            document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.payment-form');
            const emailInput = document.getElementById('email');
            const cardNumberInput = document.getElementById('card-number');
            const expiryDateInput = document.getElementById('expiry-date');
            const cvvInput = document.getElementById('cvv');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); 
   
                resetValidation();

                let valid = true;


                if (!validateEmail(emailInput.value)) {
                    showError(emailInput, 'Please enter a valid email address.');
                    valid = false;
                }

                if (!/^\d{16}$/.test(cardNumberInput.value)) {
                    showError(cardNumberInput, 'must be 16 digits.');
                    valid = false;
                }

                if (new Date(expiryDateInput.value) <= new Date()) {
                    showError(expiryDateInput, 'Please enter a valid future expiry date.');
                    valid = false;
                }

                if (!/^\d{3}$/.test(cvvInput.value)) {
                    showError(cvvInput, 'must be 3 digits.');
                    valid = false;
                }

                if (valid) {
                    showSuccessMessage();
                }
            });

            function showError(input, message) {
                const parent = input.parentElement;
                const label = parent.querySelector('label');
                label.innerHTML += ` <span class="error">${message}</span>`;
                parent.classList.add('error');
            }

            function resetValidation() {
                const errors = document.querySelectorAll('.error');
                errors.forEach(error => error.remove());
                const inputs = document.querySelectorAll('.payment-form-group, .payment-form-group-flex');
                inputs.forEach(input => input.classList.remove('error'));
            }

            function validateEmail(email) {
                const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return re.test(email);
            }

            function showSuccessMessage() {
                alert("Payment Successful\nYour payment has been successfully processed. Thank you for your booking!");
            }

        });
        </script>
    <?php include ('includes/footer.php') ?>
</body>
</html>
