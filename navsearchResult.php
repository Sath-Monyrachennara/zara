<?php
    require_once('database.php');
    global $input;
    if(isset($_POST['input'])){
        $input = $_POST['input'];
    }
    $result = db()->query("SELECT * FROM product WHERE pro_name LIKE '{$input}%' OR types LIKE '{$input}%'");
    $num_row = mysqli_num_rows($result);
    if($num_row>0){
        for($j=1; $j<=$num_row; $j++){
            if($row = mysqli_fetch_array($result)){
                $id = $row['id'];
                $pro_name = $row['pro_name'];
            }
?>
            <a href="productDetail.php?id=<?=$id?>"><?=$pro_name?></a>
<?php
        }
    }else {
        echo '<p class="nodata">Your cart is empty!</p>';
    }
?>
            