
        document.addEventListener('DOMContentLoaded', function() {
            const addOns = document.querySelectorAll('.add-on input[type="checkbox"]');
            const summaryItems = document.getElementById('summary-items');
            const totalPrice = document.getElementById('total-price');

            function updateSummary() {
                let total = 0;
                summaryItems.innerHTML = '';

                addOns.forEach(addOn => {
                    if (addOn.checked) {
                        const price = parseInt(addOn.dataset.price);
                        total += price;

                        const item = document.createElement('div');
                        item.className = 'summary-item';
                        item.innerHTML = `
                            <div>${capitalizeFirstLetter(addOn.id.replace(/-/g, ' '))}</div>
                            <div><strong>LKR ${price} per day</strong></div>
                        `;
                        summaryItems.appendChild(item);
                    }
                });

                totalPrice.innerHTML = `Total: <strong>LKR ${total}</strong> per day`;
            }

            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            addOns.forEach(addOn => {
                addOn.addEventListener('change', updateSummary);
            });

            // Initial update
            updateSummary();
        });
