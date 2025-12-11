<?php
// Kiểm tra nếu form đã được gửi và tính toán
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị a và b từ form
    $a = isset($_POST['a']) ? (int)$_POST['a'] : 0;
    $b = isset($_POST['b']) ? (int)$_POST['b'] : 0;

    // Kiểm tra nếu b bằng 0, tránh chia cho 0
    if ($b == 0) {
        $error = "Lỗi: Không thể chia cho 0.";
    } else {
        // Tính phần nguyên
        $phan_nguyen = intdiv($a, $b);
    
        // Tính phần dư
        $phan_du = $a % $b;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tính phần nguyên và phần dư</title>
</head>
<body>
    <h1>Tính phần nguyên và phần dư của a / b</h1>
    
    <!-- Form nhập liệu -->
    <form method="POST" action="">
        <label for="a">Nhập giá trị của a:</label>
        <input type="number" id="a" name="a" required><br><br>
        
        <label for="b">Nhập giá trị của b:</label>
        <input type="number" id="b" name="b" required><br><br>
        
        <input type="submit" value="Tính">
    </form>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($error)) { ?>
        <h2>Kết quả:</h2>
        <p>Phần nguyên của <?php echo $a; ?> / <?php echo $b; ?> là: <?php echo $phan_nguyen; ?></p>
        <p>Phần dư của <?php echo $a; ?> / <?php echo $b; ?> là: <?php echo $phan_du; ?></p>
    <?php } ?>
</body>
</html>
