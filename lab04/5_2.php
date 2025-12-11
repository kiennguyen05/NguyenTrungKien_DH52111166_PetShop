<?php

function showArray1($arr){
    echo"<table border=1 cellpadding='5' cellspacing='0'>";
    echo "<tr> <th>Stt</th> <th>Ma san pham</th> <th>Ten san pham</th> </tr>";

    for($i=0;$i<count($arr);$i++){
        echo "<tr>";
        echo "<td>".($i+1)."</td>";
        echo "<td>".$arr[$i]['id']."</td>";
        echo "<td>".$arr[$i]['name']."</td>";
        echo "</tr>";

    }
    echo"</table>";


}

$arr= array();
$r = array("id"=> "sp1", "name"=> "Sản phẩm 1");
$arr[] = $r;
$r = array("id"=> "sp2", "name"=> "Sản phẩm 2");
$arr[] = $r;
$r = array("id"=> "sp3", "name"=> "Sản phẩm 3");
$arr[] = $r; 
showArray1($arr);
?>



