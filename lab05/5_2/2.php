<?php
function postIndex($index, $value = "")
{
    if (!isset($_POST[$index])) return $value;
    return $_POST[$index];
}

$sm  = postIndex("submit");
$ten = postIndex("ten");
$gt  = postIndex("gt");
$arrImg = array("image/png", "image/jpeg", "image/bmp");

if ($sm == "") {
    header("location:1.php");
    exit;
}

$err = "";
if ($ten == "") $err .= "Phải nhập tên <br>";
if ($gt == "") $err .= "Phải chọn giới tính <br>";

$validFiles = [];

if (isset($_FILES["hinh"]) && is_array($_FILES["hinh"]["name"])) {
    for ($i = 0; $i < count($_FILES["hinh"]["name"]); $i++) {
        $errFile = $_FILES["hinh"]["error"][$i];
        if ($errFile > 0) {
            $err .= "Lỗi file hình thứ " . ($i + 1) . "<br>";
        } else {
            $type = $_FILES["hinh"]["type"][$i];
            if (!in_array($type, $arrImg)) {
                $err .= "File thứ " . ($i + 1) . " không phải là hình ảnh hợp lệ<br>";
            } else {
                $temp = $_FILES["hinh"]["tmp_name"][$i];
                $name = $_FILES["hinh"]["name"][$i];
                $uploadPath = "image/" . $name;

                if (!move_uploaded_file($temp, $uploadPath)) {
                    $err .= "Không thể lưu file hình thứ " . ($i + 1) . "<br>";
                } else {
                    $validFiles[] = $name;
                }
            }
        }
    }
} else {
    $err .= "Chưa chọn hình ảnh nào<br>";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab5_3/2 - Kết quả upload</title>
</head>
<body>
<?php
if ($err != "")
    echo "<div style='color:red;'>$err</div>";
else {
    if ($gt == "1") echo "Chào Anh: $ten ";
    else echo "Chào Chị: $ten ";
    echo "<hr>Hình đã upload:<br>";

    foreach ($validFiles as $file) {
        echo "<img src='image/$file' width='200' style='margin:5px; border:1px solid #ccc;'><br>";
    }
}
?>
<p><a href="1.php">Tiếp tục</a></p>
</body>
</html>
