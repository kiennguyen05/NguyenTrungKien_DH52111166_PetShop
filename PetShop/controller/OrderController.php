<?php


require_once PROJECT_ROOT . '/auth_check.php';
include_once PROJECT_ROOT . '/config/database.php';

class OrderController {

    public function __construct() {
        
        require_auth();
    }

    
    public function checkout() {
        $cartItems = $_SESSION['cart'] ?? [];
        
        if (empty($cartItems)) {
            header("Location: index.php"); 
            exit();
        }

        $totalCart = 0;
        foreach ($cartItems as $item) {
            $totalCart += $item['price'] * $item['quantity'];
        }
        
        include PROJECT_ROOT . '/view/layout/header_full.php';
        include PROJECT_ROOT . '/view/orders/checkout.php';
        include PROJECT_ROOT . '/view/layout/footer_full.php';
    }

    
    public function processPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['cart'])) {
            header('Location: index.php');
            exit();
        }

        $database = new Database();
        $db = $database->getConnection();

        $cartItems = $_SESSION['cart'];
        $payment_method = $_POST['payment_method'] ?? 'cash';
        $userId = $_SESSION['user_id'];
        
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        try {
            $db->beginTransaction();

            $order_query = "INSERT INTO orders (user_id, total_amount, status) VALUES (:user_id, :total_amount, :status)";
            $order_stmt = $db->prepare($order_query);
            $order_stmt->execute([
                ':user_id' => $userId,
                ':total_amount' => $total,
                ':status' => 'completed' 
            ]);
            $order_id = $db->lastInsertId();

            
            $details_query = "INSERT INTO order_details (order_id, product_id, quantity, unit_price) VALUES (:order_id, :product_id, :quantity, :unit_price)";
            $details_stmt = $db->prepare($details_query);

            foreach ($cartItems as $id => $item) {
                $details_stmt->execute([
                    ':order_id' => $order_id,
                    ':product_id' => $id,
                    ':quantity' => $item['quantity'],
                    ':unit_price' => $item['price']
                ]);
            }
            
           
            $invoice_query = "INSERT INTO invoices (order_id, total_amount) VALUES (:order_id, :total_amount)";
            $invoice_stmt = $db->prepare($invoice_query);
            $invoice_stmt->execute([
               ':order_id' => $order_id,
               ':total_amount' => $total
            ]);
            $invoice_id = $db->lastInsertId();

            $db->commit();

            unset($_SESSION['cart']);

            header("Location: index.php?page=invoices&action=show&id=" . $invoice_id);
            exit();

        } catch (Exception $e) {
            $db->rollBack();
            die("Lỗi khi xử lý đơn hàng: " . $e->getMessage());
        }
    }
}

