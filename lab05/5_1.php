<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lab5_2 - Form with POST and Result Display</title>
</head>
<body>

<?php
// Kiểm tra xem form đã được submit chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Hiển thị kết quả nhận được từ POST
    echo "<hr><h2>Form Submitted</h2>";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    echo "<h2>Submit Form</h2>";
}
?>

<!-- Form 1 -->
<fieldset>
<legend>Form 1</legend>
<form action="lab5_2.php" method="post">
    Nhập x: <input type="text" name="x" value="<?php echo isset($_POST['x']) ? $_POST['x'] : '1'; ?>"><br>
    Nhập y: <input type="text" name="y" value="<?php echo isset($_POST['y']) ? $_POST['y'] : '2'; ?>"><br>
    Nhập z: <input type="text" name="z" value="<?php echo isset($_POST['z']) ? $_POST['z'] : '3'; ?>"><br>
    <input type="submit" value="Submit">
</form>
</fieldset>

<!-- Form 2 -->
<fieldset>
<legend>Form 2</legend>
<form action="lab5_2.php" method="post">
    Nhập x1: <input type="text" name="x[]" value="<?php echo isset($_POST['x'][0]) ? $_POST['x'][0] : '1'; ?>"><br>
    Nhập x2: <input type="text" name="x[]" value="<?php echo isset($_POST['x'][1]) ? $_POST['x'][1] : '2'; ?>"><br>
    Nhập y: <input type="text" name="y" value="<?php echo isset($_POST['y']) ? $_POST['y'] : '3'; ?>"><br>
    <input type="submit" value="Submit">
</form>
</fieldset>

<!-- Form 3 -->
<fieldset>
<legend>Form 3</legend>
<form action="lab5_2.php" method="post">
    Nhập tên: <input type="text" name="ten" value="<?php echo isset($_POST['ten']) ? $_POST['ten'] : ''; ?>"><br>
    Giới tính:
    <input type="radio" name="gt" value="1" <?php echo (isset($_POST['gt']) && $_POST['gt'] == '1') ? 'checked' : ''; ?>> Nam
    <input type="radio" name="gt" value="0" <?php echo (isset($_POST['gt']) && $_POST['gt'] == '0') ? 'checked' : ''; ?>> Nữ<br>
    Sở thích:
    <input type="checkbox" name="st[]" value="tt" <?php echo (isset($_POST['st']) && in_array('tt', $_POST['st'])) ? 'checked' : ''; ?>> Thể Thao
    <input type="checkbox" name="st[]" value="dl" <?php echo (isset($_POST['st']) && in_array('dl', $_POST['st'])) ? 'checked' : ''; ?>> Du Lịch
    <input type="checkbox" name="st[]" value="game" <?php echo (isset($_POST['st']) && in_array('game', $_POST['st'])) ? 'checked' : ''; ?>> Game<br>
    <input type="submit" value="Submit">
</form>
</fieldset>

<hr>

<?php
// In ra các kết quả từ form sau khi submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>Form Data Submitted:</h3>";

    // Hiển thị dữ liệu từ form 1
    echo "x: " . htmlspecialchars($_POST['x']) . "<br>";
    echo "y: " . htmlspecialchars($_POST['y']) . "<br>";
    echo "z: " . htmlspecialchars($_POST['z']) . "<br>";

    // Hiển thị dữ liệu từ form 2
    echo "<hr>Form 2 (Array x[]):<br>";
    if (isset($_POST['x'])) {
        foreach ($_POST['x'] as $value) {
            echo "x[]: " . htmlspecialchars($value) . "<br>";
        }
    }

    // Hiển thị dữ liệu từ form 3
    echo "<hr>Form 3:<br>";
    echo "Tên: " . htmlspecialchars($_POST['ten']) . "<br>";
    echo "Giới tính: " . ($_POST['gt'] == '1' ? 'Nam' : 'Nữ') . "<br>";

    echo "Sở thích: ";
    if (isset($_POST['st']) && is_array($_POST['st'])) {
        echo implode(", ", $_POST['st']);
    }
    echo "<br>";
}
?>

</body>
</html>
