<pre><?php 
function showArray($arr){
    echo "<table border=1 cellpadding='5' cellspacing='0'>";
    echo "<tr> <th>Index</th> <th>Value</th> </tr>";

    foreach($arr as $key=>$value){
        echo"<tr><td>".$key."</td><td>".$value."</td></tr>";
    }

    echo "</table>";
}

$arr=array(1=>'x',3,5,7,9,12,-1);
showArray($arr);
?>