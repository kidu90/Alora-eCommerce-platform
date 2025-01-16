// Function to fetch orders
async function fetchOrders() {
    const url = 'http://localhost/Alora/api/orders/get_orders.php'; // Replace with your actual API endpoint

    try {
        console.log('Fetching orders...');
        // Send a GET request to the API
        const response = await fetch(url);
        
        // Check if the response is ok (status 200)
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        // Parse the JSON data from the response
        const data = await response.json();
        console.log('Orders data:', data);
        
        // Check if the response contains data
        if (data.status === 'success') {
            return data.data; // Return the orders data
        } else {
            throw new Error('Failed to fetch orders: ' + data.message);
        }
    } catch (error) {
        console.error('Error fetching orders:', error);
        return [];
    }
}

// Function to display orders in a table
async function displayOrders() {
    const orders = await fetchOrders();

    // Get the table body element
    const tableBody = document.getElementById('ordersTableBody');
    
    // Check if there are orders to display
    if (orders.length > 0) {
        // Clear any existing rows
        tableBody.innerHTML = '';
        
        // Loop through the orders and create table rows
        orders.forEach(order => {
            const row = document.createElement('tr');
            
            row.innerHTML = `
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.order_id}</td>
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.user_id}</td>
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.order_date}</td>
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.total_amount}</td>
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.status}</td>
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.shipping_address}</td>
                <td class="px-4 py-2 text-sm text-gray-700 border-b">${order.payment_status}</td>
            `;
            
            // Append the row to the table body
            tableBody.appendChild(row);
        });
    } else {
        // If no orders found, display a message
        tableBody.innerHTML = '<tr><td colspan="7" class="px-4 py-2 text-center text-gray-700">No orders found</td></tr>';
    }
}

// Call the displayOrders function when the page loads
document.addEventListener('DOMContentLoaded', displayOrders);
