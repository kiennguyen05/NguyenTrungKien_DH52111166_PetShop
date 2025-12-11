<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Lab 3_4</title>
</head>

<body>
	<?php
	function kiemtranguyento($x) //Kiểm tra 1 số có nguyên tố hay không
	{
		if ($x < 2)
			return false;
		if ($x == 2)
			return true;
		$i = 2;
		do {
			if ($x % $i == 0)
				return false;
			$i++;
		} while ($i <= sqrt($x));
		return true;
	}

	if (isset($_POST['submit'])) {
		$number = $_POST['number'];


		if (!is_numeric($number)) {
			echo "Vui long nhap so";
		} else {

			if (kiemtranguyento($number))
				echo  $number . "là số nguyên tố";
			else
				echo $number . "không phải số nguyên tố";
		}
	}
	?>

	<form method="post" action="">
		<input type="text" name="number" placeholder="number" />
		<input type="submit" name="submit" value="kiem tra" />
	</form>
</body>

</html>