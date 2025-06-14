<?php

if (isset($_GET['price'])) {
    $price = htmlspecialchars($_GET['price']); // Sanitize output
} else {
    $price = 'Price not set';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-ons | Vehicle Rental System</title>
    <link rel="stylesheet" href="styles/tailwindcss-colors.css">
    <link rel="stylesheet" href="styles/adons-style.css">
     <style>
        .controls {
            display: flex;
            align-items: center;
        }
        .controls button {
            padding: 5px 10px;
            margin: 0 5px;
        }
        .controls span {
            font-weight: bold;
            margin: 0 10px;
        }
    </style>
</head>
<body>
    <?php include ('includes/header.php')?><br><br><br><br>
   <!-- <div class="nav-container">
        <nav>
            <img src="./images/logo.png" class="logo">
            <ul>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <Button id="sign-up" class="buttons">Sign-up</Button>
            <Button id="login" class="buttons">Login</Button>
        </nav>
    </div>  -->

    <div class="container">
        <div class="add-ons-section">
            <h1>Add-ons</h1>

              <div class="add-on">
                 <label>No Of Day</label>
                     <div class="controls">
            
                        <button onclick="decreaseDays()">-</button>
            
                        <span id="numDays">1</span>

                        <button onclick="increaseDays()">+</button>
                    </div>
        
                <p>LKR <span id="totalPrice"><?php echo $price; ?></span></p>
                
            </div>

            <br><p>Select add-ons to enhance your rental experience.</p><br>

            <div class="add-on">
                <label>
                    <input type="checkbox" data-price="1200" id="gps-navigetion"> GPS Navigation
                </label>
                <span>LKR 1,200 per day</span>
            </div>
            <div class="add-on">
                <label>
                    <input type="checkbox" data-price="2400" id="additional-driver"> Additional Driver
                </label>
                <span>LKR 2,400 per day</span>
            </div>
            <div class="add-on">
                <label>
                    <input type="checkbox" data-price="1800" id="child-seat"> Child Seat
                </label>
                <span>LKR 1,800 per day</span>
            </div>
            <div class="add-on">
                <label>
                    <input type="checkbox" data-price="3600" id="insurance"> Insurance
                </label>
                <span>LKR 3,600 per day</span>
            </div>
        </div>

        <div class="summary">
            <h2>Summary</h2>
            <div id="summary-items"></div>
            <div class="summary-total" id="total-price">Total: LKR 0 per day</div>
            
            <!-- Form to submit selected add-ons -->
            <form id="addons-form" action="payment.php" method="POST">
                <input type="hidden" name="selected_addons" id="selected-addons">
                <input type="hidden" name="total_price" id="total-price-value">
                <button id="confirm" type="submit">Confirm Selection</button>
            </form>
        </div>
    </div>

    <script>
        let days = 1;
        const pricePerDay = <?php echo $price; ?>;
        
        // Function to increase the number of days
        function increaseDays() {
            days++;
            updateDaysAndPrice();
        }

        // Function to decrease the number of days
        function decreaseDays() {
            if (days > 1) { // Ensure the number of days is at least 1
                days--;
                updateDaysAndPrice();
            }
        }

        // Function to update the number of days and the total price
        function updateDaysAndPrice() {
            document.getElementById('numDays').textContent = days;
            document.getElementById('totalPrice').textContent = (days * pricePerDay).toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const addOns = document.querySelectorAll('.add-on input[type="checkbox"]');
            const summaryItems = document.getElementById('summary-items');
            const totalPrice = document.getElementById('total-price');
            const selectedAddonsInput = document.getElementById('selected-addons');
            const totalPriceValueInput = document.getElementById('total-price-value');

            function updateSummary() {
                let total = 0 ;
                let selectedAddOns = [];
                summaryItems.innerHTML = '';

                addOns.forEach(addOn => {
                    if (addOn.checked) {
                        const price = parseInt(addOn.dataset.price);
                        total += price ;

                        const item = document.createElement('div');
                        item.className = 'summary-item';
                        item.innerHTML = `
                            <div>${capitalizeFirstLetter(addOn.id.replace(/-/g, ' '))}</div>
                            <div><strong>LKR ${price} per day</strong></div>
                        `;
                        summaryItems.appendChild(item);

                        // Add selected add-on to the list
                        selectedAddOns.push({
                            name: capitalizeFirstLetter(addOn.id.replace(/-/g, ' ')),
                            price: price
                        });
                    }
                });

                totalPrice.innerHTML = `Total: <strong>LKR ${total}</strong> per day`;

                // Update hidden form fields
                selectedAddonsInput.value = JSON.stringify(selectedAddOns);
                totalPriceValueInput.value = total  ;
            }

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            addOns.forEach(addOn => {
                addOn.addEventListener('change', updateSummary);
            });

            updateSummary();
        });
    </script><br><br><br>
    <?php include ('includes/footer.php') ?>
</body>

</html>
