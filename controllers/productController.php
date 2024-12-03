<?php
include_once 'dbconnection.php';
include_once 'models/productModel.php';

class ProductController
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new ProductModel($db);
    }

    public function getAllProducts()
    {
        $products = $this->productModel->getAllProducts();
        if (!empty($products)) {
            http_response_code(200);
            echo json_encode([
                "status" => "success",
                "message" => "Products retrieved successfully",
                "data" => $products
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                "status" => "error",
                "message" => "No products found"
            ]);
        }
    }
}
