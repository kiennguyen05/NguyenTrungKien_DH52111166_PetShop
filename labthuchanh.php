<?php
function labButton($labNum) {
    $folder = "lab" . str_pad($labNum, 2, '0', STR_PAD_LEFT);

    if (is_dir($folder)) {
        echo '<a class="lab-btn" href="' . $folder . '/">📘 Bài tập Tuần ' . $labNum . '</a>';
    } else {
        echo '<a class="lab-btn disabled">📗 Bài tập Tuần ' . $labNum . ' </a>';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab thực hành</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .lab-btn {
            display: block;
            width: 100%;
            padding: 12px;
            font-size: 17px;
            background: white;
            border: 1px solid #d0d0d0;
            border-radius: 8px;
            margin-bottom: 15px;
            text-align: left;
            color: #0d6efd;
            font-weight: 500;
            transition: 0.2s;
            text-decoration: none;
        }
        .lab-btn:hover {
            background-color: #e9f0ff;
            color: #0a58ca;
        }
        .lab-btn.disabled {
            color: #888;
            pointer-events: none;
            background-color: #f1f1f1;
            border-color: #ddd;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="text-center mb-5">
        <h1 class="display-5">Lab thực hành</h1>
        <p class="lead">Danh sách các bài tập thực hành môn Lập trình Web.</p>
        <a href="/index.php" class="btn btn-secondary mt-3">🏠 Quay lại trang chủ</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4">
            <?php for ($i = 1; $i <= 5; $i++) labButton($i); ?>
        </div>
        <div class="col-md-4">
            <?php for ($i = 6; $i <= 10; $i++) labButton($i); ?>
        </div>
    </div>
</div>

</body>
</html>
