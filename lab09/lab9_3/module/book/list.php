<?php
if (!defined("ROOT"))
{
	echo "Err!"; exit;	
}
$cat_id = getIndex("cat_id", "all");
$pub_id = getIndex("pub_id", "all");
$sql ="select * from book where 1 ";
$arr = array();
if ($cat_id !="all")
{	$sql .=" and cat_id =:cat_id ";
	$arr[":cat_id"] = $cat_id;
}

if ($pub_id !="all")
{	$sql .=" and pub_id =:pub_id ";
	$arr[":pub_id"] = $pub_id;
}

$list = $book->exeQuery($sql, $arr);
echo "Có ".$book->getRowCount() ." kết quả";
foreach($list as $r)
{
	?>
    <div class="book" style="border-bottom: 1px solid #ccc; padding: 10px; display: flex; align-items: center;">
        <img src="image/book/<?php echo $r['img']; ?>" width="50" style="margin-right: 15px;">
    	<div style="flex-grow: 1;">
            <?php echo $r["book_name"];?>
        </div>
        <a href="index.php?mod=cart&ac=add&id=<?php echo $r['book_id']; ?>">Mua ngay</a>
    </div>
    <?php	
}

?>