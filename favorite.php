<?php
    require_once('database.php');
    global $id, $pro_name, $pro_price, $image, $type, $favid, $delid;
    
    
    if(isset($_POST['favid'])){
        $id = $_POST['favid'];
        $userId = $_POST['userId'];
    }

    $results = db()->query("SELECT * FROM `product` WHERE `id` = '$id'");
    $num_rows = mysqli_num_rows($results);
    if($num_rows >0){
        if($rows = mysqli_fetch_array($results)){
            $id = $rows['id'];
            $pro_name = $rows['pro_name'];
            $pro_price = $rows['pro_price'];
            $image = $rows['image'];
            $type = $rows['types'];
        }
    }

    $comName = db()->query("SELECT * FROM `favorites` WHERE `user_id` = '$userId' AND `pro_name` = '$pro_name'");
    $num_row = mysqli_num_rows($comName);
    
    if(!empty($pro_name) && $num_row ==0 && $userId >0){
        $insertData = db()->query("INSERT INTO `favorites`(user_id, pro_name, pro_price, types, pro_image) VALUES('$userId', '$pro_name', '$pro_price', '$type', '$image')");
    } 

    if(isset($_GET['proName']) || isset($_GET['delid'])){
        $proName = $_GET['proName'];
        $delid = $_GET['delid'];
        $deletedfav = db()->query("DELETE FROM `favorites` WHERE `pro_name` = '$proName' OR `id` = '$delid'");
    }

?>

<div class="fav" id="fav">
    <i class="fa-solid fa-xmark" onclick="cancel()"></i>
    <div class="showfav">
        <?php
            $result = db()->query("SELECT * FROM favorites WHERE user_id = '$userId'");
            $num_row = mysqli_num_rows($result);
            if($num_row >0){
                for($i=1; $i<=$num_row; $i++){
                    if($row = mysqli_fetch_array($result)){
                        $id = $row['id'];
                        $pro_name = $row['pro_name'];
                        $pro_price = $row['pro_price'];
                        $image = $row['pro_image'];
                        $types = $row['types'];
                    }
        ?>
                    <div class="fav_row">
                        <div class="fav_col">
                            <a href="productDetail.php?id=<?=$id?>"> <img src="Images/productImg/<?=$image?>" alt=""> </a>
                        </div>
                        <div class="fav_col favcol2">
                            <a href="productDetail.php?id=<?=$id?>" id="proName"><?=$pro_name ?></a>
                            <small><?=$types?></small>
                            <p id="favpro_price">$<?=$pro_price?>.00 <span class="fa-solid fa-heart hearts"></span></p>
                            <button type="button" id="<?=$id?>" class="delete_btn" >Delete</button>
                        </div>
                    </div>
        <?php
                }
            }else {
                echo '<p id="faempty">Your favorite is empty!</p>';
            }
        ?>
    </div>
</div>
