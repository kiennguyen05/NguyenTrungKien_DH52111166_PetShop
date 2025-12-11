<?php
// Khai báo biến để lưu thông báo lỗi và dữ liệu hợp lệ
$err = "";
$validData = false;
$userdata = [];

// Kiểm tra nếu form đã được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];
    $province = isset($_POST['province']) ? $_POST['province'] : '';
    
    // Kiểm tra mật khẩu và xác nhận mật khẩu có khớp không
    if ($password !== $confirm_password) {
        $err .= "Mật khẩu và xác nhận mật khẩu không trùng khớp. <br>";
    }

    // Kiểm tra các trường bắt buộc
    if (empty($username)) $err .= "Tên đăng nhập là bắt buộc. <br>";
    if (empty($password)) $err .= "Mật khẩu là bắt buộc. <br>";
    if (empty($gender)) $err .= "Giới tính là bắt buộc. <br>";
    if (empty($province)) $err .= "Tỉnh là bắt buộc. <br>";
    
    // Kiểm tra xem người dùng có chọn file hình ảnh hay không
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $validImageTypes = ['image/jpeg', 'image/png', 'image/bmp', 'image/gif'];
        $imageType = $_FILES['image']['type'];
        if (!in_array($imageType, $validImageTypes)) {
            $err .= "Hình ảnh phải có định dạng .jpg, .png, .bmp, hoặc .gif. <br>";
        } else {
            $imageName = $_FILES['image']['name'];
            $imageTemp = $_FILES['image']['tmp_name'];
            $imagePath = "uploads/" . $imageName;
            
            // Di chuyển file lên thư mục 'uploads/'
            if (!move_uploaded_file($imageTemp, $imagePath)) {
                $err .= "Không thể lưu hình ảnh. <br>";
            }
        }
    }
    
    // Nếu không có lỗi, lưu thông tin và hiển thị
    if (empty($err)) {
        $validData = true;
        $userdata = [
            'username' => $username,
            'gender' => $gender,
            'hobbies' => implode(", ", $hobbies), // Sở thích có thể chọn nhiều
            'province' => $province,
            'image' => isset($imageName) ? $imageName : null
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Ký Thông Tin Thành Viên</title>
    <style>
        fieldset { width: 50%; margin: 50px auto; }
        label { display: block; margin: 5px 0; }
        input[type="text"], input[type="password"], select, input[type="file"] { width: 100%; padding: 8px; }
        input[type="submit"], input[type="reset"] { margin-top: 10px; padding: 10px 20px; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <fieldset>
        <legend>Đăng Ký Thông Tin Thành Viên</legend>
        
        <!-- Form Đăng Ký -->
        <form action="lab5_4_3.php" method="post" enctype="multipart/form-data">
            <label for="username">Tên đăng nhập (*):</label>
            <input type="text" name="username" id="username" value="<?= isset($username) ? $username : ''; ?>" required>

            <label for="password">Mật khẩu (*):</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Nhập lại mật khẩu (*):</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <label for="gender">Giới tính (*):</label>
            <input type="radio" name="gender" value="Male" <?= isset($gender) && $gender == 'Male' ? 'checked' : ''; ?>> Nam
            <input type="radio" name="gender" value="Female" <?= isset($gender) && $gender == 'Female' ? 'checked' : ''; ?>> Nữ

            <label for="hobbies">Sở thích:</label>
            <input type="checkbox" name="hobbies[]" value="Reading" <?= isset($hobbies) && in_array('Reading', $hobbies) ? 'checked' : ''; ?>> Đọc sách
            <input type="checkbox" name="hobbies[]" value="Sports" <?= isset($hobbies) && in_array('Sports', $hobbies) ? 'checked' : ''; ?>> Thể thao
            <input type="checkbox" name="hobbies[]" value="Gaming" <?= isset($hobbies) && in_array('Gaming', $hobbies) ? 'checked' : ''; ?>> Chơi game

            <label for="province">Tỉnh (*):</label>
            <select name="province" id="province" required>
                <option value="">Chọn tỉnh</option>
                <option value="Hanoi" <?= isset($province) && $province == 'Hanoi' ? 'selected' : ''; ?>>Hà Nội</option>
                <option value="HCM" <?= isset($province) && $province == 'HCM' ? 'selected' : ''; ?>>TP. Hồ Chí Minh</option>
                <option value="DaNang" <?= isset($province) && $province == 'DaNang' ? 'selected' : ''; ?>>Đà Nẵng</option>
            </select>

            <label for="image">Hình ảnh (tùy chọn):</label>
            <input type="file" name="image" id="image">

            <input type="submit" value="Đăng ký" name="submit">
            <input type="reset" value="Reset">
        </form>

        <!-- Hiển thị lỗi nếu có -->
        <?php if (!empty($err)) { ?>
            <div class="error"><?= $err ?></div>
        <?php } ?>

        <!-- Hiển thị dữ liệu hợp lệ nếu không có lỗi -->
        <?php if ($validData) { ?>
            <h3>Thông tin bạn đã nhập:</h3>
            <ul>
                <li>Tên đăng nhập: <?= $userdata['username'] ?></li>
                <li>Giới tính: <?= $userdata['gender'] ?></li>
                <li>Sở thích: <?= $userdata['hobbies'] ?></li>
                <li>Tỉnh: <?= $userdata['province'] ?></li>
                <?php if ($userdata['image']) { ?>
                    <li>Hình ảnh: <img src="uploads/<?= $userdata['image'] ?>" width="100" alt="Image"></li>
                <?php } ?>
            </ul>
        <?php } ?>
    </fieldset>
</body>
</html>
