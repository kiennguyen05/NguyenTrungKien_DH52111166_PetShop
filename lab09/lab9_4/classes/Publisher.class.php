<?php
class Publisher extends Db{
	
	public function getAll()
	{
		return $this->exeQuery("select * from publisher");
	}

    public function getById($pub_id)
	{
		$sql="select publisher.* 
			from publisher
			where  publisher.pub_id=:pub_id ";
		$arr = array(":pub_id"=>$pub_id);
		$data = $this->exeQuery($sql, $arr);
		if (Count($data)>0) return $data[0];
		else return array();
	}
	
}
?>