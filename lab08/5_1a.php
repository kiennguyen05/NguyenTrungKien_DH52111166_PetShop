<?php
include_once '5_1.php';

// Số sách hiển thị trên mỗi trang
$limit = 10;

// Tính toán trang hiện tại
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Khởi tạo đối tượng Book
$book = new Book();

// Lấy tổng số sách
$total_books = $book->getTotalBooks();

// Tính số trang cần thiết
$total_pages = ceil($total_books / $limit);

// Lấy danh sách sách cho trang hiện tại
$books = $book->getBooksByPage($limit, $offset);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sách</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { padding: 10px; text-align: left; border: 1px solid #ddd; }
        .pagination { text-align: center; margin-top: 20px; }
        .pagination a { margin: 0 5px; text-decoration: none; padding: 8px 12px; background-color: #ddd; border-radius: 5px; }
        .pagination a:hover { background-color: #007bff; color: white; }
    </style>
</head>
<body>

<h1>Danh sách sách</h1>

<table>
    <tr>
            <th>Mã sách</th>
            <th>Tên sách</th>
            <th>Mô tả</th>
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Mã NXB</th>
            <th>Mã loại</th>
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
        </tr>
    <?php endforeach; ?>

</table>

<!-- Phân trang -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=1">Đầu</a>
        <a href="?page=<?php echo $page - 1; ?>">Trước</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'style="background-color: #007bff; color: white;"'; ?>>
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Sau</a>
        <a href="?page=<?php echo $total_pages; ?>">Cuối</a>
    <?php endif; ?>
</div>

</body>
</html>
