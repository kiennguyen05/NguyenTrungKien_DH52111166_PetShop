<?php
try{
    $pdh = new PDO("mysql:host=localhost; dbname=bookstore", "root", "");
    $pdh->query("set names 'utf8'");
}
catch(Exception $e){
    echo $e->getMessage(); exit;
}

if (isset($_GET["book_id"])) {
    $id = $_GET["book_id"];

    // Truy vấn để xóa sách
    $sql = "DELETE FROM book WHERE book_id = :id";
    $stm = $pdh->prepare($sql);
    $stm->bindValue(":id", $id);
    $stm->execute();

    // Quay lại trang quản lý sách
    header("Location: 4_2.php");
}
?>
