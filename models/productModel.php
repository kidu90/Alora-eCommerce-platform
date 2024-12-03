<?php
include 'dbconnection.php';

class ProductModel
{
    private $db;
    private $table = 'products';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllProducts()
    {
        // Prepare the SQL statement
        $sql = "SELECT * FROM " . $this->db->real_escape_string($this->table);

        // Execute the query
        $result = $this->db->query($sql);

        // Check for query execution errors
        if (!$result) {
            throw new Exception("Query failed: " . $this->db->error);
        }

        // Check if products exist
        if ($result->num_rows > 0) {
            $products = [];
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }

            // Free the result set
            $result->free();

            return $products;
        } else {
            return [];
        }
    }
}
