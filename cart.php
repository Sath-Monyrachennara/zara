<?php
    /* Add to cart */
    require_once('database.php');
    global $proId, $qty, $userId, $pro_name, $pro_price, $image, $size, $color, $type;

    if(isset($_POST['id'])){
        $proId = $_POST['id'];
        $userId = $_POST['userId'];
        $qty = $_POST['qty'];
        $color = $_POST['color'];
        $size = $_POST['size'];
    }

    $selectedData = db()->query("SELECT * FROM `product` WHERE `id` = '$proId'");
    if($row = mysqli_fetch_array($selectedData)){
        $pro_name = $row['pro_name'];
        $pro_price = $row['pro_price'];
        $image = $row['image'];
        $type = $row['types'];
    }

    if(!empty($_POST['qty'])){
        $insertData = db()->query("INSERT INTO `cart`(`user_id`, `pro_name`, `pro_price`, `quantity`, `size`, `color`, `pro_image`) VALUES('$userId', '$pro_name', '$pro_price', '$qty', '$size', '$color', '$image')");
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $deletepro = db()->query("DELETE FROM `cart` WHERE `id` = '$id'");
    }
    
?>
<p><?=$qty?></p>
<section class="cart" id="cart">
        <div class="cartHeader">
            <i class="fa-solid fa-angle-left"></i>
            <h2>shopping bag</h2>
        </div>
        <div class="shopCart">
            <div class="showCart">
                <?php
                    $result = db()->query("SELECT * FROM cart WHERE user_id = '$userId'");
                    $num_row = mysqli_num_rows($result);
                    if($num_row >0){
                        for($i=1; $i<=$num_row; $i++){
                            if($row = mysqli_fetch_array($result)){
                                $id = $row['id'];
                                $pro_name = $row['pro_name'];
                                $pro_price = $row['pro_price'];
                                $qty = $row['quantity'];
                                $size = $row['size'];
                                $color = $row['color'];
                                $image = $row['pro_image'];
                            }
                ?>
                            <div class="cartPro">
                                <img src="Images/productImg/<?=$image?>" alt="Product Image11">
                                <div class="proDeta">
                                    <h2><?=$pro_name?></h2>
                                    <p id="cartpro_qty">Qty: <span><?=$qty?></span> </p>
                                    <p>Size: <span><?= empty($size) ? "none" : $size?></span> </p>
                                    <div class="proDeta_row">
                                        <p>Color: <span><?=$color?></span> </p>
                                        <p id="prices">$<?=$pro_price?>.00</p>
                                    </div>
                                    <div class="cartBtn">
                                        <a href="" class="editBtn">Edit</a>
                                        <a href="cart.php?id=<?=$id?>" class="removeBtn">Remove</a>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }else {
                        echo '<p class="cartEmpty">Your cart is empty!</p>';
                    }
                ?>
            </div>
            <div class="subTotal_cart">
                <p>Subtotal: <span>$345.00</span></p>
            </div>

            <a href="checkOut.php" id="checkOut_btn">CHECKOUT</a>
            <a href="shop.php" id="contShop">Continue Shopping > </a>
        </div>
    </section> 