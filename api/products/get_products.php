<?php
require_once '../../dbconnection.php';



// print_r($user);

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


require_once '../../dbconnection.php';

function getFilteredProducts($page = 1, $limit = 10, $category = null, $minPrice = null, $maxPrice = null, $search = '')
{
    global $conn;

    try {
        // Calculate offset for pagination
        $offset = ($page - 1) * $limit;

        // Start with the base query
        $sql = "SELECT p.product_id, p.name, p.description, p.price, p.category_id, 
                       p.stock_quantity, p.ingredients, p.usage_tips, p.image_url, 
                       p.created_at, c.name as category_name
                FROM products p
                LEFT JOIN categories c ON p.category_id = c.category_id
                WHERE 1=1"; // Default condition to always return results

        // Add filters if provided
        if ($category) {
            $sql .= " AND p.category_id = ?";
        }
        if ($minPrice) {
            $sql .= " AND p.price >= ?";
        }
        if ($maxPrice) {
            $sql .= " AND p.price <= ?";
        }
        if ($search) {
            $sql .= " AND p.name LIKE ?";
        }

        // Add pagination
        $sql .= " LIMIT ? OFFSET ?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        // Bind parameters dynamically
        $params = [];
        $types = '';

        // Always bind page and limit at the end for pagination
        $params[] = $limit;
        $params[] = $offset;
        $types = 'ii';

        // Bind dynamic filters
        if ($category) {
            $params[] = $category;
            $types .= 'i';
        }
        if ($minPrice) {
            $params[] = $minPrice;
            $types .= 'd';  // For double (price)
        }
        if ($maxPrice) {
            $params[] = $maxPrice;
            $types .= 'd';  // For double (price)
        }
        if ($search) {
            $params[] = '%' . $search . '%';
            $types .= 's';  // For string (search term)
        }

        // Bind all the parameters
        $stmt->bind_param($types, ...$params);

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
        $countSql = "SELECT COUNT(*) AS total FROM products p
                     LEFT JOIN categories c ON p.category_id = c.category_id
                     WHERE 1=1";

        // Add the same conditions as the main query for total count
        if ($category) {
            $countSql .= " AND p.category_id = ?";
        }
        if ($minPrice) {
            $countSql .= " AND p.price >= ?";
        }
        if ($maxPrice) {
            $countSql .= " AND p.price <= ?";
        }
        if ($search) {
            $countSql .= " AND p.name LIKE ?";
        }

        // Execute the count query
        $countStmt = $conn->prepare($countSql);
        if (!$countStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        // Bind parameters for count query
        $countParams = [];
        $countTypes = 'ii';  // Bind for limit and offset

        if ($category) {
            $countParams[] = $category;
            $countTypes .= 'i';
        }
        if ($minPrice) {
            $countParams[] = $minPrice;
            $countTypes .= 'd';
        }
        if ($maxPrice) {
            $countParams[] = $maxPrice;
            $countTypes .= 'd';
        }
        if ($search) {
            $countParams[] = '%' . $search . '%';
            $countTypes .= 's';
        }

        $countStmt->bind_param($countTypes, ...$countParams);

        if (!$countStmt->execute()) {
            throw new Exception("Execute failed: " . $countStmt->error);
        }

        $countResult = $countStmt->get_result();
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

// Handle query parameters
$page = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_VALIDATE_INT) : 1;
$limit = isset($_GET['limit']) ? filter_var($_GET['limit'], FILTER_VALIDATE_INT) : 10;
$category = isset($_GET['category']) ? filter_var($_GET['category'], FILTER_VALIDATE_INT) : null;
$minPrice = isset($_GET['minPrice']) ? filter_var($_GET['minPrice'], FILTER_VALIDATE_FLOAT) : null;
$maxPrice = isset($_GET['maxPrice']) ? filter_var($_GET['maxPrice'], FILTER_VALIDATE_FLOAT) : null;
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch the filtered products
$response = getFilteredProducts($page, $limit, $category, $minPrice, $maxPrice, $search);

// Output the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
