<?php

class Db {
    protected $pdo;

    // Kết nối cơ sở dữ liệu
    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->query("SET NAMES 'utf8'");
        } catch (Exception $e) {
            echo "Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage();
            exit;
        }
    }

    // Lấy kết nối PDO
    public function getConnection() {
        return $this->pdo;
    }
}
?>
