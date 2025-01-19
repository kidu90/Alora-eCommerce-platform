document.getElementById("checkout-btn").addEventListener("click", async () => {
    const shippingAddress = document.querySelector("input[placeholder='Enter your address']").value;

    if (!shippingAddress) {
        alert("Please provide a shipping address.");
        return;
    }

    const orderData = {
        user_id: 1, // Replace with the actual user ID
        shipping_address: shippingAddress,
        order_items: cartItems.map(item => ({
            product_id: item.productId,
            quantity: item.quantity,
            price_per_unit: item.productPrice
        }))
    };

    // Send order data to the backend API
    try {
        const response = await fetch('', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(orderData),
        });

        const result = await response.json();

        if (result.status === 'success') {
            alert("Order placed successfully!");
            localStorage.removeItem("userCart"); 
            window.location.reload(); 
        } else {
            alert(`Error: ${result.message}`);
        }
    } catch (error) {
        console.error("Error placing order:", error);
        alert("Failed to place order. Please try again later.");
    }
});
