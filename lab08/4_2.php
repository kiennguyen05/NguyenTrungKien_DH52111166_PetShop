<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quản lý sách</title>
<style>
#container{width:700px; margin:0 auto;}
table {border-collapse: collapse;}
td, th {padding: 6px; border:1px solid #555;}
</style>
</head>

<body>
<div id="container">

<h2>Thêm sách mới</h2>

<form action="4_2.php" method="post" enctype="multipart/form-data">
<table>
<tr><td>Mã sách:</td><td><input type="text" name="book_id" required /></td></tr>
<tr><td>Tên sách:</td><td><input type="text" name="book_name" required /></td></tr>
<tr><td>Mô tả:</td><td><textarea name="description" required></textarea></td></tr>
<tr><td>Giá:</td><td><input type="number" name="price" required /></td></tr>
<tr><td>Hình ảnh:</td><td><input type="file" name="img" required /></td></tr>
<tr><td>Mã NXB:</td><td><input type="text" name="pub_id" required /></td></tr>
<tr><td>Mã loại:</td><td><input type="text" name="cat_id" required /></td></tr>

<tr><td colspan="2"> <input type="submit" name="sm" value="Insert" /></td></tr>
</table>
</form>

<?php
/* ======== CONNECT DATABASE ======== */
try{
    $pdh = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
    $pdh->query(" set names 'utf8' ");
}
catch(Exception $e){
    echo $e->getMessage(); exit;
}

/* ======== XỬ LÝ INSERT ======== */
if (isset($_POST["sm"]))
{
    // Xử lý file upload
    $img = $_FILES['img']['name'];
    $target = "uploads/" . basename($img);
    move_uploaded_file($_FILES['img']['tmp_name'], $target);
    
    // Thêm vào CSDL
    $sql="INSERT INTO book(book_id, book_name, description, price, img, pub_id, cat_id)
          VALUES(:book_id, :book_name, :description, :price, :img, :pub_id, :cat_id)";
    $arr = array(
        ":book_id" => $_POST["book_id"],
        ":book_name" => $_POST["book_name"],
        ":description" => $_POST["description"],
        ":price" => $_POST["price"],
        ":img" => $img,
        ":pub_id" => $_POST["pub_id"],
        ":cat_id" => $_POST["cat_id"]
    );

    $stm = $pdh->prepare($sql);
    $stm->execute($arr);
    $n = $stm->rowCount();

    echo ($n > 0) ? "<p>Thêm sách thành công!</p>" : "<p>Lỗi thêm sách!</p>";
}

/* ======== HIỂN THỊ DANH SÁCH SÁCH ======== */
$stm = $pdh->prepare("SELECT * FROM book");
$stm->execute();
$rows = $stm->fetchAll(PDO::FETCH_ASSOC);
?>

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

<?php
foreach($rows as $row)
{
	echo "<tr>";
	echo "<td>{$row['book_id']}</td>";
	echo "<td>{$row['book_name']}</td>";
	echo "<td>{$row['description']}</td>";
	echo "<td>{$row['price']}</td>";
	echo "<td><img src='database/{$row['img']}' width='100'></td>";
	echo "<td>{$row['pub_id']}</td>";
	echo "<td>{$row['cat_id']}</td>";
	echo "<td><a href='4_2_xoa.php?book_id={$row['book_id']}'>Xóa</a></td>";
	echo "</tr>";
}
?>
</table>

</div>
</body>
</html>
