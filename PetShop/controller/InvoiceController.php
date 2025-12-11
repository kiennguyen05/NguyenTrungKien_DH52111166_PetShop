<?php

require_once PROJECT_ROOT . '/auth_check.php';
include_once PROJECT_ROOT . '/config/database.php';

class InvoiceController {
    private $db;

    public function __construct() {
        require_auth(); 
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function index() {
        
        $query = "SELECT i.id as invoice_id, i.invoice_date, i.total_amount, o.id as order_id, u.username
                  FROM invoices i
                  JOIN orders o ON i.order_id = o.id
                  JOIN users u ON o.user_id = u.id";

       
        $filter_date = $_GET['date'] ?? '';
        if ($filter_date) {
            $query .= " WHERE DATE(i.invoice_date) = :filter_date";
        }
        
        $query .= " ORDER BY i.invoice_date DESC";
        $stmt = $this->db->prepare($query);

        if ($filter_date) {
            $stmt->bindParam(':filter_date', $filter_date);
        }

        $stmt->execute();
        $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include PROJECT_ROOT . '/view/layout/header_full.php';
        include PROJECT_ROOT . '/view/invoices/list.php';
        include PROJECT_ROOT . '/view/layout/footer_full.php';
    }

    public function show() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?page=invoices");
            exit();
        }
        $invoice_id = $_GET['id'];

        
        $query = "SELECT i.id as invoice_id, i.invoice_date, i.total_amount, o.id as order_id, u.username
                  FROM invoices i
                  JOIN orders o ON i.order_id = o.id
                  JOIN users u ON o.user_id = u.id
                  WHERE i.id = :invoice_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':invoice_id', $invoice_id, PDO::PARAM_INT);
        $stmt->execute();
        $invoice_info = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$invoice_info) {
             echo "Không tìm thấy hóa đơn.";
             exit();
        }

        
        $details_query = "SELECT od.quantity, od.unit_price, p.name as product_name
                          FROM order_details od
                          JOIN products p ON od.product_id = p.id
                          WHERE od.order_id = :order_id";
        $details_stmt = $this->db->prepare($details_query);
        $details_stmt->bindParam(':order_id', $invoice_info['order_id'], PDO::PARAM_INT);
        $details_stmt->execute();
        $order_details = $details_stmt->fetchAll(PDO::FETCH_ASSOC);

        include PROJECT_ROOT . '/view/layout/header_full.php';
        include PROJECT_ROOT . '/view/invoices/show.php';
        include PROJECT_ROOT . '/view/layout/footer_full.php';
    }
}
