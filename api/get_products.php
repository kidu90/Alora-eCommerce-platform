<?php
require_once '../dbconnection.php';

function getAllProducts($page = 1, $limit = 10)
{
    global $conn;

    try {
        // Calculate offset for pagination
        $offset = ($page - 1) * $limit;

        $sql = "SELECT p.product_id, p.name, p.description, p.price, p.category_id, 
                       p.stock_quantity, p.ingredients, p.usage_tips, p.image_url, 
                       p.created_at, c.name as category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                LIMIT ? OFFSET ?";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ii", $limit, $offset);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        // Fetch all products
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        // Get total number of products for pagination
        $countSql = "SELECT COUNT(*) AS total FROM products";
        $countResult = $conn->query($countSql);
        if (!$countResult) {
            throw new Exception("Count query failed: " . $conn->error);
        }

        $totalRow = $countResult->fetch_assoc();
        $totalProducts = $totalRow['total'];
        $totalPages = ceil($totalProducts / $limit);

        return [
            "status" => "success",
            "data" => $products,
            "pagination" => [
                "total_products" => $totalProducts,
                "total_pages" => $totalPages,
                "current_page" => $page,
                "per_page" => $limit
            ]
        ];
    } catch (Exception $e) {
        http_response_code(500);
        return [
            "status" => "error",
            "message" => "Failed to fetch products",
            "error" => $e->getMessage()
        ];
    }
}

function getProductById($id)
{
    global $conn;

    try {
        $stmt = $conn->prepare(
            "SELECT p.product_id, p.name, p.description, p.price, p.category_id, 
                    p.stock_quantity, p.ingredients, p.usage_tips, p.image_url, 
                    p.created_at, c.name as category_name
             FROM products p
             LEFT JOIN categories c ON p.category_id = c.category_id
             WHERE p.product_id = ?"
        );

        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            return [
                "status" => "success",
                "data" => $product
            ];
        } else {
            throw new Exception("Product with ID $id not found.");
        }
    } catch (Exception $e) {
        http_response_code($e->getMessage() === "Product with ID $id not found." ? 404 : 500);
        return [
            "status" => "error",
            "message" => $e->getMessage()
        ];
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
    }
}

header('Content-Type: application/json');

// Get pagination parameters from the query string
$page = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_VALIDATE_INT) : 1;
$limit = isset($_GET['limit']) ? filter_var($_GET['limit'], FILTER_VALIDATE_INT) : 10;

// Validate pagination parameters
if ($page === false || $page <= 0) {
    $page = 1; // Default to page 1 if invalid page number
}
if ($limit === false || $limit <= 0) {
    $limit = 10; // Default to 10 items per page if invalid limit
}

// Sanitize input if ID is provided
if (isset($_GET['id'])) {
    $productId = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($productId === false) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Invalid product ID provided"
        ]);
        exit();
    }

    // Fetch detailed product data by ID
    $response = getProductById($productId);
} else {
    // Fetch all products with pagination
    $response = getAllProducts($page, $limit);
}

echo json_encode($response);
