<?php 
if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $a=isset($_POST['a']) ? $_POST['a'] :'';
    
    if(is_numeric($a)){
        if(is_int($a+0)){
            $result="$a la so nguyen";
        }
        else{
            $result="$a la so thuc";
        }
    }
    else {
    $error="vui long nhap 1 so hop le";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiem tra so nguyen so thuc</title>
</head>
<body>

<form method="post" action="">
    <label for="a">Nhap gia tri cua a:</label>
    <input type="text" id="a" name="a" require><br><br>

    <input type="submit" value="kiem tra">

</form>

<?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($result)) { ?>
        <h2>Kết quả:</h2>
        <p><?php echo $result; ?></p>
    <?php } ?>
    
</body>
</html>