<?php
class News extends Db{
	public $PageSize = 10;

	public function getAll($page)
	{
		$offset = ($page - 1) * $this->PageSize;
        // Chuyển đổi sang kiểu số nguyên để đảm bảo an toàn
        $offset = (int)$offset;
        $pageSize = (int)$this->PageSize;
		$sql="SELECT id, title, img, short_content, content, hot FROM news ORDER BY id DESC LIMIT $offset, $pageSize";
		return $this->exeQuery($sql);	
	}
	
	public function getDetail($id)
	{
		$sql="SELECT * FROM news WHERE id = ?";
		$arr = array($id);
		$data = $this->exeQuery($sql, $arr);
		if (count($data)>0)
			return $data[0];
		else 
			return array();
	}

	public function getTotalPages()
    {
        $sql = "SELECT COUNT(*) as total FROM news";
        $result = $this->exeQuery($sql);
        $totalRecords = $result[0]['total'];
        return ceil($totalRecords / $this->PageSize);
    }
}
?>