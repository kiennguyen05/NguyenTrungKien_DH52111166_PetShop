<?php

include_once PROJECT_ROOT . '/config/database.php';
include_once PROJECT_ROOT . '/models/Product.php';

class ProductController {
    public function index() {
       
        $database = new Database();
        $db = $database->getConnection();
        
        $product = new Product($db);
        
        
        $stmt = $product->read();
        
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        include PROJECT_ROOT . '/view/layout/header.php';
        include PROJECT_ROOT . '/view/products/list.php';
        include PROJECT_ROOT . '/view/layout/footer.php';
    }

    public function manage() {
        
        $database = new Database();
        $db = $database->getConnection();
        
        $product = new Product($db);
        
        
        $stmt = $product->read();
        
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include PROJECT_ROOT . '/view/layout/header_full.php';
        include PROJECT_ROOT . '/view/products/manage.php';
        include PROJECT_ROOT . '/view/layout/footer_full.php';
    }

    public function create() {
        
        include PROJECT_ROOT . '/view/layout/header_full.php';
        include PROJECT_ROOT . '/view/products/create.php';
        include PROJECT_ROOT . '/view/layout/footer_full.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=products&action=manage');
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

       
        $product->id = $_POST['id'];
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->stock = $_POST['stock'];
        $product->img_url = $_POST['img_url']; 

        if ($product->create()) {
            
            header('Location: index.php?page=products&action=manage');
        } else {
          
            die('Không thể tạo sản phẩm.');
        }
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=products&action=manage');
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);
        $product->id = $_GET['id'];
        
        if (!$product->readOne()) {
            die('Sản phẩm không tìm thấy.');
        }

        
        include PROJECT_ROOT . '/view/layout/header_full.php';
        include PROJECT_ROOT . '/view/products/edit.php';
        include PROJECT_ROOT . '/view/layout/footer_full.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
            header('Location: index.php?page=products&action=manage');
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        
        $product->id = $_POST['id'];
        $product->name = $_POST['name'];
        $product->description = $_POST['description'];
        $product->price = $_POST['price'];
        $product->stock = $_POST['stock'];
        $product->img_url = $_POST['img_url'];

        if ($product->update()) {
            header('Location: index.php?page=products&action=manage');
        } else {
            die('Không thể cập nhật sản phẩm.');
        }
    }

    public function delete() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=products&action=manage');
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);
        $product->id = $_GET['id'];

        if ($product->delete()) {
            header('Location: index.php?page=products&action=manage');
        } else {
            die('Không thể xóa sản phẩm.');
        }
    }
}
