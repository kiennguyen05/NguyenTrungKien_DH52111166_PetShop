<?php
// models/Product.php

class Product {
    // Database connection and table name
    private $conn;
    private $table_name = "products";

    // Object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $img_url;

    // Constructor with $db as database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Read all products
    function read() {
        $query = "SELECT id, name, description, price, stock, img_url FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Search products by name
    function search($searchTerm) {
        $query = "SELECT id, name, description, price, stock, img_url FROM " . $this->table_name . " WHERE name LIKE ? ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $searchTerm = "%" . htmlspecialchars(strip_tags($searchTerm)) . "%";

        // Bind value
        $stmt->bindParam(1, $searchTerm);

        $stmt->execute();
        return $stmt;
    }

    // Read single product
    function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->price = $row['price'];
            $this->stock = $row['stock'];
            $this->img_url = $row['img_url'];
            return true;
        }
        return false;
    }

    // Create product
    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET id=:id, name=:name, description=:description, price=:price, stock=:stock, img_url=:img_url";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->img_url=htmlspecialchars(strip_tags($this->img_url));

        // Bind values
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":img_url", $this->img_url);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Update the product
    function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, price = :price, stock = :stock, img_url = :img_url WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->stock=htmlspecialchars(strip_tags($this->stock));
        $this->img_url=htmlspecialchars(strip_tags($this->img_url));

        // Bind values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':stock', $this->stock);
        $stmt->bindParam(':img_url', $this->img_url);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete the product
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        // Sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));

        // Bind id of record to delete
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
