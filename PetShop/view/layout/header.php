<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Shop POS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Pet Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">↩️ Quay lại trang chọn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Trang chủ (Bán hàng)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=invoices">Lịch sử Hóa đơn</a>
                </li>
                
                <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Quản trị
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                        <li><a class="dropdown-item" href="index.php?page=products&action=manage">Quản lý Sản phẩm</a></li>
                        <li><a class="dropdown-item" href="index.php?page=admin&action=manageAccounts">Quản lý Tài khoản</a></li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
            
            <div class="d-flex">
                <?php if(isset($_SESSION['username'])): ?>
                    <span class="navbar-text text-white me-3">
                        Chào, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>!
                    </span>
                    <a href="logout.php" class="btn btn-sm btn-outline-light">Đăng xuất</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-sm btn-primary">Đăng nhập Admin</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<div class="main-content">
