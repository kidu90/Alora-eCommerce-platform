<div class="max-w-md mx-auto mt-10 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 text-left">Update Order Status</h2>
    <form id="update-order-status-form" class="space-y-6">
        <div>
            <label for="order-id" class="block text-sm font-medium text-gray-700">Order ID:</label>
            <input
                type="number"
                id="order-id"
                name="order_id"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Enter Order ID"
                required />
        </div>

        <div>
            <label for="payment-status" class="block text-sm font-medium text-gray-700">Payment Status:</label>
            <select
                id="payment-status"
                name="payment_status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Order Status:</label>
            <select
                id="status"
                name="status"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <button
            type="submit"
            class="w-full bg-gray-200 text-black px-6 py-2 rounded-lg hover:bg-gray-100 mt-4 inline-block">
            Update Order Status
        </button>
    </form>
</div>

<script>
    // Update order status form submission
    document.getElementById("update-order-status-form").addEventListener("submit", async (event) => {
        event.preventDefault();

        const orderId = document.getElementById("order-id").value;
        const paymentStatus = document.getElementById("payment-status").value;
        const status = document.getElementById("status").value;

        try {
            const response = await updateOrderStatus(orderId, paymentStatus, status);
            if (response.status === "success") {
                alert("Order status updated successfully!");
            } else {
                alert(`Error: ${response.message}`);
            }
        } catch (error) {
            console.error("Error updating order status:", error);
            alert("Failed to update order status. Please try again.");
        }
    });

    // Function to update order status
    async function updateOrderStatus(orderId, paymentStatus, status) {
        const apiUrl = "http://localhost/Alora/api/orders/update_order.php";

        const requestData = {
            order_id: parseInt(orderId),
            payment_status: paymentStatus,
            status: status,
        };

        const response = await fetch(apiUrl, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify(requestData),
        });

        return response.json();
    }
</script>