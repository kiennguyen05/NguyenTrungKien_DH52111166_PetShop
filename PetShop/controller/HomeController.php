<?php


require_once PROJECT_ROOT . '/auth_check.php';
include_once PROJECT_ROOT . '/config/database.php';
include_once PROJECT_ROOT . '/models/Product.php';

class HomeController {
    public function index() {
        
        require_auth(); 

        
        $database = new Database();
        $db = $database->getConnection();
        $product = new Product($db);

        
        $searchTerm = $_GET['search'] ?? '';
        if (!empty($searchTerm)) {
            $stmt = $product->search($searchTerm);
        } else {
            $stmt = $product->read();
        }
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

       
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

       
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
            $pId = $_POST['product_id'];
            
            if (isset($_POST['action'])) {
                 $action = $_POST['action'];
                if ($action == 'add') {
                    if (isset($_SESSION['cart'][$pId])) {
                        $_SESSION['cart'][$pId]['quantity']++;
                    } else {
                        
                        $product->id = $pId;
                        if($product->readOne()){
                             $_SESSION['cart'][$pId] = [
                                'id' => $pId,
                                'name' => $product->name,
                                'price' => $product->price,
                                'img_url' => $product->img_url,
                                'quantity' => 1
                            ];
                        }
                    }
                } elseif ($action == 'decrease' && isset($_SESSION['cart'][$pId])) {
                    if ($_SESSION['cart'][$pId]['quantity'] > 1) {
                        $_SESSION['cart'][$pId]['quantity']--;
                    } else {
                        unset($_SESSION['cart'][$pId]);
                    }
                }
            }
            
            
            header("Location: index.php");
            exit;
        }

        $cartItems = $_SESSION['cart'];
        $totalCart = 0;
        foreach($cartItems as $item){
            $totalCart += $item['quantity'] * $item['price'];
        }
        
        
        include PROJECT_ROOT . '/view/layout/header.php';
        include PROJECT_ROOT . '/view/home.php';
        include PROJECT_ROOT . '/view/layout/footer.php';
    }
}