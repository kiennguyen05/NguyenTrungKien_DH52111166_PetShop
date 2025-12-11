<?php
include_once '4_3_Db.php';  // Bao gồm class Db để sử dụng kết nối cơ sở dữ liệu

class Book extends Db {

    // Thêm sách vào cơ sở dữ liệu
    public function addBook($book_id, $book_name, $description, $price, $img, $pub_id, $cat_id) {
        // Xử lý file upload (nếu có)
        $target = __DIR__ . "/database/" . basename($img);
        move_uploaded_file($_FILES['img']['tmp_name'], $target);

        $sql = "INSERT INTO book (book_id, book_name, description, price, img, pub_id, cat_id)
                VALUES (:book_id, :book_name, :description, :price, :img, :pub_id, :cat_id)";
        
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(":book_id", $book_id);
        $stmt->bindParam(":book_name", $book_name);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":img", $img);
        $stmt->bindParam(":pub_id", $pub_id);
        $stmt->bindParam(":cat_id", $cat_id);
        
        $stmt->execute();
    }

    // Hiển thị danh sách sách
    public function getBooks() {
        $sql = "SELECT * FROM book";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa sách theo book_id
    public function deleteBook($book_id) {
        $sql = "DELETE FROM book WHERE book_id = :book_id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(":book_id", $book_id);
        $stmt->execute();
    }
}
?>
