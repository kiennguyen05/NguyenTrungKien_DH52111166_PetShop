<?php
include_once '4_3_book.php';

$book = new Book(); // Khởi tạo đối tượng Book

// Xử lý khi form thêm sách được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sm'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $img = $_FILES['img']['name'];
    $pub_id = $_POST['pub_id'];
    $cat_id = $_POST['cat_id'];

    // Thêm sách
    $book->addBook($book_id, $book_name, $description, $price, $img, $pub_id, $cat_id);
    echo "Thêm sách thành công!";
}

// Lấy danh sách sách
$books = $book->getBooks();

// Xử lý khi xóa sách
if (isset($_GET['book_id'])) {
    $book->deleteBook($_GET['book_id']);
    header("Location: 4_3_bookmgn.php");  // Điều hướng lại trang sau khi xóa
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sách</title>
    <style>
        #container{width:700px; margin:0 auto;}
        table {border-collapse: collapse;}
        td, th {padding: 6px; border:1px solid #555;}
    </style>
</head>
<body>
<div id="container">
    <h2>Thêm sách mới</h2>
    <form action="4_3_bookmgn.php" method="post" enctype="multipart/form-data">
        <table>
            <tr><td>Mã sách:</td><td><input type="text" name="book_id" required /></td></tr>
            <tr><td>Tên sách:</td><td><input type="text" name="book_name" required /></td></tr>
            <tr><td>Mô tả:</td><td><textarea name="description" required></textarea></td></tr>
            <tr><td>Giá:</td><td><input type="number" name="price" required /></td></tr>
            <tr><td>Hình ảnh:</td><td><input type="file" name="img" required /></td></tr>
            <tr><td>Mã NXB:</td><td><input type="text" name="pub_id" required /></td></tr>
            <tr><td>Mã loại:</td><td><input type="text" name="cat_id" required /></td></tr>
            <tr><td colspan="2"> <input type="submit" name="sm" value="Thêm Sách" /></td></tr>
        </table>
    </form>

    <h2>Danh sách sách</h2>
    <table>
        <tr>
            <th>Mã sách</th>
            <th>Tên sách</th>
            <th>Mô tả</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Mã NXB</th>
            <th>Mã loại</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo $book['book_id']; ?></td>
                <td><?php echo $book['book_name']; ?></td>
                <td><?php echo $book['description']; ?></td>
                <td><?php echo $book['price']; ?></td>
                <td><img src="database/<?php echo $book['img']; ?>" width="100"></td>
                <td><?php echo $book['pub_id']; ?></td>
                <td><?php echo $book['cat_id']; ?></td>
                <td><a href="4_2_xoa.php?book_id=<?php echo $book['book_id']; ?>">Xóa</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
