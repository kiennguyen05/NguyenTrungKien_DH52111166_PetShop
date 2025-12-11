<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab 3_5</title>

<body>
<?php
/*
bảng cửu chương $n, màu nền $color
- Input: $n là một số nguyên dương (1->10)
		 $color: Tên màu nền.Mặc định là green
- Output: Bảng cửu chương, được xuât trong hàm
*/
function BCC($n, $colorHead = "green", $color1 = "lightyellow", $color2 = "lightgray")
{
	?>
	<table border="1" cellpadding="5" cellspacing="0">
	<tr bgcolor="<?php echo $colorHead;?>">
	<td colspan="3">Bảng cửu chương <?php echo $n;?></td></tr>
	<?php
		for($i=1; $i<=10; $i++)
		{
			$bgColor=($i % 2 == 0) ? $color2 : $color1;
			?>
			<tr bgcolor="<?php echo $bgColor;?>">
				<td><?php echo $n;?></td>
				<td><?php echo $i;?></td>
				<td><?php echo $n*$i;?></td>
			</tr>
			<?php
		}
		?>
		</table>
	<?php	
}

Bcc(6,"red");	

?>
</body>
</html>