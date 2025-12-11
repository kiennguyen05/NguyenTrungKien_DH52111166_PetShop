<?php
// Kiểm tra khi form được gửi và tính toán
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nhận giá trị của a, b, c
    $a = isset($_POST['a']) ? $_POST['a'] : 0;
    $b = isset($_POST['b']) ? $_POST['b'] : 0;
    $c = isset($_POST['c']) ? $_POST['c'] : 0;

    // Tính delta
    $delta = $b * $b - 4 * $a * $c;

    // Giải phương trình
    if ($delta > 0) {
        // Hai nghiệm phân biệt
        $x1 = (-$b + sqrt($delta)) / (2 * $a);
        $x2 = (-$b - sqrt($delta)) / (2 * $a);
        $result = "Phương trình có 2 nghiệm phân biệt: x1 = $x1 và x2 = $x2";
    } elseif ($delta == 0) {
        // Nghiệm kép
        $x1 = -$b / (2 * $a);
        $result = "Phương trình có nghiệm kép: x = $x1";
    } else {
        // Vô nghiệm thực
        $result = "Phương trình vô nghiệm thực (delta âm).";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải phương trình bậc 2</title>
</head>
<body>
    <h1>Giải phương trình bậc 2</h1>
    
    <form method="POST" action="">
        <label for="a">Nhập giá trị của a:</label>
        <input type="number" id="a" name="a" required><br><br>

        <label for="b">Nhập giá trị của b:</label>
        <input type="number" id="b" name="b" required><br><br>

        <label for="c">Nhập giá trị của c:</label>
        <input type="number" id="c" name="c" required><br><br>

        <input type="submit" value="Giải">
    </form>

    <?php if (isset($result)) { ?>
        <h2>Kết quả:</h2>
        <p><?php echo $result; ?></p>
    <?php } ?>
</body>
</html>
