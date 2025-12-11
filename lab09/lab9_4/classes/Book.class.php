<?php
class Book extends Db
{
    public $pageSize = 5; // Số sách trên 1 trang

    public function getRand($n)
    {
        $sql = "select book_id, book_name, img from book order by rand() limit 0, $n ";
        return $this->exeQuery($sql);
    }

    // Hàm xóa sách
    public function delete($book_id)
    {
        $sql = "delete from book where book_id=:book_id ";
        $arr =  Array(":book_id" => $book_id);
        return $this->exeNoneQuery($sql, $arr);
    }

    // Hàm lấy chi tiết 1 cuốn sách
    public function getDetail($book_id)
    {
        $sql = "select book.*, pub_name, cat_name 
            from book
            JOIN publisher ON book.pub_id = publisher.pub_id
            JOIN category ON book.cat_id = category.cat_id
            where book_id=:book_id ";
        $arr = array(":book_id" => $book_id);
        $data = $this->exeQuery($sql, $arr);
        if (Count($data) > 0) return $data[0];
        else return array();
    }

    // Hàm thêm sách
    public function addBook($data)
    {
        if (empty($data['book_name']) || empty($data['price']) || empty($data['cat_id']) || empty($data['pub_id'])) {
            return false;
        }
        $sql = "INSERT INTO book (book_name, description, price, img, pub_id, cat_id) 
                VALUES (:name, :desc, :price, :img, :pub, :cat)";
        $arr = [
            ':name' => $data['book_name'],
            ':desc' => $data['description'],
            ':price' => $data['price'],
            ':img' => $data['img'],
            ':pub' => $data['pub_id'],
            ':cat' => $data['cat_id']
        ];
        return $this->exeNoneQuery($sql, $arr) > 0;
    }

    // Hàm cập nhật sách
    public function updateBook($id, $data)
    {
        if (empty($id) || empty($data['book_name']) || empty($data['price']) || empty($data['cat_id']) || empty($data['pub_id'])) {
            return false;
        }
        $sql = "UPDATE book SET 
                    book_name = :name,
                    description = :desc,
                    price = :price,
                    img = :img,
                    pub_id = :pub,
                    cat_id = :cat
                WHERE book_id = :id";
        $arr = [
            ':name' => $data['book_name'],
            ':desc' => $data['description'],
            ':price' => $data['price'],
            ':img' => $data['img'],
            ':pub' => $data['pub_id'],
            ':cat' => $data['cat_id'],
            ':id' => $id
        ];
        return $this->exeNoneQuery($sql, $arr) > 0;
    }

    /**
     * =================================================================
     * PHẦN TÌM KIẾM NÂNG CAO (ĐÃ SỬA LỖI)
     * =================================================================
     */

    /**
     * Hàm hỗ trợ xây dựng câu lệnh WHERE và mảng tham số
     * Lưu ý: Đã thêm tiền tố 'book.' để tránh lỗi trùng tên cột khi JOIN
     */
    private function buildSearchQuery($params)
    {
        $sql = " WHERE 1=1 "; 
        $arr = array();

        // 1. Tìm theo tên sách
        if (!empty($params['name'])) {
            $sql .= " AND book.book_name LIKE ? ";
            $arr[] = "%" . $params['name'] . "%";
        }

        // 2. Tìm theo danh mục (cat_id)
        if (!empty($params['cat_id'])) {
            $sql .= " AND book.cat_id = ? ";
            $arr[] = $params['cat_id'];
        }

        // 3. Tìm theo nhà xuất bản (pub_id)
        if (!empty($params['pub_id'])) {
            $sql .= " AND book.pub_id = ? ";
            $arr[] = $params['pub_id'];
        }

        // 4. Tìm theo giá tối thiểu
        if (!empty($params['min_price'])) {
            $sql .= " AND book.price >= ? ";
            $arr[] = $params['min_price'];
        }

        // 5. Tìm theo giá tối đa
        if (!empty($params['max_price'])) {
            $sql .= " AND book.price <= ? ";
            $arr[] = $params['max_price'];
        }

        return ['sql' => $sql, 'arr' => $arr];
    }

    // Hàm tìm kiếm và phân trang
    public function searchAdvanced($params, $page = 1)
    {
        $query_parts = $this->buildSearchQuery($params);
        $sql_where = $query_parts['sql'];
        $arr = $query_parts['arr'];

        $offset = ($page - 1) * $this->pageSize;

        // Đã thêm FROM và INNER JOIN
        $sql = "SELECT
                book.book_id, book.book_name, book.description, book.price, book.img,
                category.cat_name, publisher.pub_name
                FROM book
                INNER JOIN category ON book.cat_id = category.cat_id
                INNER JOIN publisher ON book.pub_id = publisher.pub_id "
                . $sql_where .
                " LIMIT $offset, " . $this->pageSize;

        return $this->exeQuery($sql, $arr);
    }

    // Hàm đếm tổng số kết quả tìm kiếm (để phân trang)
    public function countSearchAdvanced($params)
    {
        $queryData = $this->buildSearchQuery($params);
        
        // Đếm trên bảng book là đủ
        $sql = "SELECT COUNT(*) as total FROM book " . $queryData['sql'];
        $arr = $queryData['arr'];

        $result = $this->exeQuery($sql, $arr);
        
        if (isset($result[0]['total'])) {
            return $result[0]['total'];
        }
        return 0;
    }
    
    // Hàm getAll cũ của bạn (có thể giữ lại hoặc không dùng tới nếu đã dùng searchAdvanced)
    public function getAll($filters = [], $page = 1)
    {
        // Bạn có thể chuyển hướng sang dùng hàm searchAdvanced ở đây cho gọn
        // hoặc giữ nguyên code cũ nếu muốn.
        return $this->searchAdvanced($filters, $page);
    }
}
?>