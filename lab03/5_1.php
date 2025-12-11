<form method="post" action="">
    <input type="text" name="number" placeholder="number">
    <input type="submit" name="" value="xuat">
</form>

<?php
    if($_SERVER["REQUEST_METHOD"]="POST"){
        $n=$_POST["number"];
    function xuatSoNguyenToDauTien($n, $tt){
        if($n < $tt) {
            echo "Số lượng không được lớn hơn giới hạn";
            return;
        }
        echo "$tt Số nguyên tố đầu tiên từ 1 đến $n: <br>";
        $dem = 0;
        $i=2;
        while ($dem<$n)
        {   
                if(kiemtranguyento($i)) {
                    if($dem<$tt)
                        echo $i . " ";
                    $dem++;
                }
                $i++;
        
        }
    }

}
?>