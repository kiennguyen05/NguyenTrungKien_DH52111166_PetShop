<?php
// PetShop/auth_check.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Checks if a user is authenticated and optionally has a specific role.
 * Redirects to login page or shows a 403 Forbidden error if checks fail.
 *
 * @param string|null $role The required role (e.g., 'admin'). If null, only checks for login.
 */
function require_auth($role = null) {
    
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    if ($role !== null) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
           
            http_response_code(403);
           
            include PROJECT_ROOT . '/view/layout/header_full.php';
            echo '<div class="container mt-5"><div class="alert alert-danger"><h1>403 Forbidden</h1><p>Bạn không có quyền truy cập trang này.</p><a href="index.php">Quay lại trang chủ</a></div></div>';
            include PROJECT_ROOT . '/view/layout/footer_full.php';
            exit;
        }
    }
}
