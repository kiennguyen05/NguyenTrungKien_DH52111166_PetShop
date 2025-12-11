<?php
// controller/CartController.php

include_once PROJECT_ROOT . '/config/database.php';
include_once PROJECT_ROOT . '/models/Product.php';

class CartController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    private function redirect() {
        
        header("Location: index.php?page=products");
        exit();
    }

    public function add() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $product = new Product($this->db);
                $product->id = $id;
                if ($product->readOne()) {
                    $_SESSION['cart'][$id] = [
                        "name" => $product->name,
                        "price" => $product->price,
                        "quantity" => 1
                    ];
                }
            }
        }
        $this->redirect();
    }

    public function update() {
        if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
            $id = $_GET['id'];
            $change = isset($_GET['change']) ? (int)$_GET['change'] : 0;

            if ($change !== 0) {
                $_SESSION['cart'][$id]['quantity'] += $change;
            }

           
            if ($_SESSION['cart'][$id]['quantity'] <= 0) {
                unset($_SESSION['cart'][$id]);
            }
        }
        $this->redirect();
    }

    public function remove() {
        if (isset($_GET['id'])) {
            unset($_SESSION['cart'][$_GET['id']]);
        }
        $this->redirect();
    }

    public function index() {
        
        $productController = new ProductController();
        $productController->index();
    }
}
