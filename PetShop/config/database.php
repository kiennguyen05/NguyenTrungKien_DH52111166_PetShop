<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
// PetShop/config/database.php

class Database {
    private $host = "127.0.0.1";
    private $db_name = "quanlipetshop";
    private $username = "root";
    private $password = ""; // Assuming default XAMPP/WAMP password
    public $conn;

    // Get the database connection
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Lỗi kết nối: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

// Hàm format tiền tệ VNĐ
function formatMoney($amount) {
    return number_format($amount, 0, ',', '.') . ' đ';
}
?>
