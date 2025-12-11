<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab8_2 - PDO - MySQL - Select - Insert - Parameter</title>
</head>
<body>

<h2>Tìm kiếm sách theo tên</h2>
<form method="post">
    <label for="search">Nhập tên sách:</label>
    <input type="text" id="search" name="search" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>" />
    <input type="submit" value="Tìm kiếm" />
</form>

<?php
try {
    $pdh = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
    $pdh->query("set names 'utf8'");
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}

// Kiểm tra nếu người dùng đã nhập tìm kiếm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search = $_POST['search']; // Lấy từ form
    if (!empty($search)) {
        // SQL để tìm kiếm sách theo tên
        $sql = "SELECT * FROM book WHERE book_name LIKE :ten";
        $stm = $pdh->prepare($sql);
        $stm->bindValue(":ten", "%" . $search . "%");
        $stm->execute();
        $rows = $stm->fetchAll(PDO::FETCH_ASSOC);

        // Hiển thị kết quả tìm kiếm
        if ($rows) {
            echo "<h3>Kết quả tìm kiếm:</h3>";
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Tên sách</th>
                        <th>Mo ta</th>
                        <th>Nhà xuất bản</th>
                    </tr>";
            foreach ($rows as $row) {
                echo "<tr>
                        <td>{$row['book_id']}</td>
                        <td>{$row['book_name']}</td>
                        <td>{$row['description']}</td>
                        <td>{$row['pub_id']}</td>
                    </tr>";
            }
            echo "</table>";
        } else {
            echo "Không tìm thấy sách nào với tên '$search'.";
        }
    } else {
        echo "Vui lòng nhập tên sách cần tìm.";
    }
}

?>

</body>
</html>
