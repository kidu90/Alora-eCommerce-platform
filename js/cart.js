document.getElementById("checkout-btn").addEventListener("click", async () => {
    const shippingAddress = document.querySelector("input[placeholder='Enter your address']").value;

    if (!shippingAddress) {
        alert("Please provide a shipping address.");
        return;
    }

    // Prepare order data
    const orderData = {
        user_id: 1, // Replace with actual logged-in user ID
        shipping_address: shippingAddress,
        order_items: cartItems.map(item => ({
            product_id: item.productId,
            quantity: item.quantity,
            price_per_unit: item.productPrice
        }))
    };

    // Send order data to the backend API
    try {
        const response = await fetch('/path-to-your-api/order-endpoint.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(orderData),
        });

        const result = await response.json();

        if (result.status === 'success') {
            alert("Order placed successfully!");
            localStorage.removeItem("userCart"); // Clear cart
            window.location.reload(); // Reload page or redirect
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error("Error placing order:", error);
        alert("Failed to place order. Please try again later.");
    }
});
