<?php

class News extends Db {

    // Lấy danh sách các tin tức
    public function list() {
        $sql = "SELECT * FROM news";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy chi tiết tin tức theo ID
    public function detail($id) {
        $sql = "SELECT * FROM news WHERE id = :id";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
