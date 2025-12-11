<?php


require_once PROJECT_ROOT . '/auth_check.php';
include_once PROJECT_ROOT . '/config/database.php';
include_once PROJECT_ROOT . '/models/User.php';

class AdminController {

    private $db;
    private $userModel;

    public function __construct() {
        
        require_auth('admin');

        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    
    public function index() {
        $page_title = "Admin Dashboard";

        include_once PROJECT_ROOT . '/view/layout/header_full.php';
        include_once PROJECT_ROOT . '/view/admin/dashboard.php';
        include_once PROJECT_ROOT . '/view/layout/footer_full.php';
    }

    
    public function manageAccounts() {
        $page_title = "Quản lý Tài khoản";
        
       
        $stmt = $this->userModel->read();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include_once PROJECT_ROOT . '/view/layout/header_full.php';
        include_once PROJECT_ROOT . '/view/admin/accounts.php';
        include_once PROJECT_ROOT . '/view/layout/footer_full.php';
    }


    public function storeAccount() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?page=admin&action=manageAccounts');
            exit();
        }

        $this->userModel->username = $_POST['username'];
        $this->userModel->password = $_POST['password'];
        $this->userModel->email = $_POST['email'];
        $this->userModel->role = $_POST['role'];

        if (empty($this->userModel->username) || empty($this->userModel->password) || empty($this->userModel->role)) {
            die('Tên đăng nhập, mật khẩu, và vai trò không được để trống.');
        }

        if ($this->userModel->usernameExists()) {
            die('Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.');
        }

        if ($this->userModel->create()) {
            header('Location: index.php?page=admin&action=manageAccounts');
        } else {
            die('Không thể tạo tài khoản.');
        }
    }
}
