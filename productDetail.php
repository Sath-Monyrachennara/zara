<?php
    session_start();
    require_once('database.php');
    
    // Session
    global $userId, $userName;
    if(isset($_SESSION['user_Id'])) {
        $userId = $_SESSION['user_Id'];
        $userName = $_SESSION['userName'];
    }
    
    $comid = db()->query("SELECT * FROM `user` WHERE `id` = '$userId'");
    $row = mysqli_num_rows($comid);
    if($row >0 ) {
        $userId = $_SESSION['user_Id'];
    }else {
        $userId = 0;
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>
    <!-- Ajax Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <!-- CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font awsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- Bootstrap CND Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'; ?> 
    <section class="proDetail">
        <div class="proDetail_header">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shopHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="productDetail.php">Product detail</li>
                </ol>
            </nav>
        </div>
    
        <div class="showproDetail">
            <?php
                global $id, $pro_id, $pro_name, $pro_price, $materials, $detail, $type;

                if(isset($_GET['id'])){
                    $pro_id = $_GET['id'];
                }

                $result = db()->query("SELECT * FROM `product` WHERE `id`='$pro_id'");
                $num_row = mysqli_num_rows($result);
                if($num_row > 0){
                    if($row = mysqli_fetch_array($result)){
                        $id = $row['id'];
                        $pro_name = $row['pro_name'];
                        $pro_price = $row['pro_price'];
                        $image = $row['image'];
                        $prodetai_img = $row['productDetail_img'];
                        $detail = $row['detail'];
                        $materials = $row['materials'];
                        $type = $row['types'];
                        $discount_price = $row['discount_prices'];
                    }
            ?>
                    <!-- Show detail product images -->
                    <div class="showdetImg">
                        <?php
                            $totalFile = glob("images/proDetail/$prodetai_img/". "*");
                            foreach($totalFile as $totalFiles)
                            {
                        ?>
                                <div class="img_slide">
                                    <img src="<?=$totalFiles?>" alt="Image" class="smallImg <?= strstr($totalFiles,'img1') ? 'pro_pagination': ''; ?>"> </li>
                                </div>
                        <?php
                            }
                        ?>
                    </div>
            <?php
                }
            ?>  

            <div class="showdetImg" id="showdetImg">
                <img src="Images/productImg/<?=$image ?>" alt="Image" id="mainImg">
            </div>
            <div class="showDteail">
                <div class="row1">
                    <p id="userId" style="display:none;"><?=$userId?></p>
                    <p id="namepro"><?=$pro_name?></p>
                    <i class="fa-regular fa-bookmark"></i>
                </div>
                <p id="price">$<?=$pro_price?>.00</p>
                <p id="desc"><?=$detail?></p>
                <div class="meterials">
                    <h2>MATERIALS</h2>
                    <div><?=$materials?></div>
                </div>
                <form action="" method="post">
                    <p>Select color</p>
                    <?php
                        if($type !== 'accessories'){
                    ?>
                        <div class="color">
                            <button type="button" id="black" name="black" value="black" style="background-color: #000;"></button>
                            <button type="button" id="red" name="red" value="red" style="background-color: red;"></button>
                            <button type="button" id="pink" name="pink" value="pink" style="background-color: pink;"></button>
                            <button type="button" id="blue" name="blue" value="blue" style="background-color: blue;"></button>
                            <button type="button" id="gray" name="gray" value="gray" style="background-color: gray;"></button>
                            <button type="button" id="yellow" name="yellow" value="yellow" style="background-color: yellow;"></button>
                        </div>
                    <?php
                        }else {
                            echo '<p style="font-size: 14px; margin: 0px;">No color</p>';
                        }
                    ?>
                    <p>Select size</p>
                    <div class="size">
                        <?php
                            if($type == 'shoes'){
                                for($x=35; $x<=40; $x++){

                        ?>
                                    <button type="button" name="<?=$x?>" id="<?=$x?>" value="<?=$x?>"><?=$x?></button>
                        <?php
                                }
                            }else if($type == "jackets" || $type == "dresses"){
                                $sizes = array("xs","s","m","l","xl","xxl");
                                for($y=0; $y<6; $y++){
                        ?>
                                    <button type="button" name="<?=$sizes[$y]?>" id="<?=$sizes[$y]?>"><?=$sizes[$y]?></button>
                        <?php
                                }
                            }else {
                                echo '<p style="font-size: 14px; margin: 0px;">No size</p>';
                            }
                        ?>
                    </div>
                    <small>size guide</small>
                    <div class="addBag">
                        <input type="number" id="quantity" name="quantity" value=1 min="1">
                        <button class="addtoBag" type="submit" name="addtoBag" id=<?=$id?>>add to bag</button>
                    </div>
                    <div class="addFav">
                        <div class="favorite">
                            <p id="favid" style="display:none;"><?=$id?></p>
                            <?php
                                global $heartIcon;
                                $comName = db()->query("SELECT * FROM favorites WHERE pro_name = '$pro_name' AND user_id = '$userId'");
                                $num_rows = mysqli_num_rows($comName);
                                if($num_rows>0){
                                    $heartIcon = 1;
                                    echo '<i class="fa-solid fa-heart hearts" id="solidHeart"></i>';
                                }else {
                                    echo '<i class="fa-regular fa-heart" id="hearts"></i>';
                                }
                            ?>
                            <i class="fa-regular fa-heart" id="hearts" style="display:none;"></i>
                            <i class="fa-solid fa-heart hearts" id="solidHeart" style="display:none"></i>
                            <p>Add to favorite</p>
                        </div>
                        <div class="instock">
                            <i class="fa-solid fa-check"></i>
                            <p>In stock</p>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        <div class="realPro">
            <h2>related products</h2>
            <div class="swiper mySwiper">
                <!-- Swiper2 -->
                <div class="swiper-wrapper relatedPro">
                    <?php
                        $relatedPro = db()->query("SELECT * FROM product WHERE types = '$type' AND pro_name != '$pro_name'");
                        $num_rows = mysqli_num_rows($relatedPro);
                        if($num_rows > 0){
                            for($i=1; $i<=$num_rows; $i++){
                                if($rows = mysqli_fetch_array($relatedPro)){
                                    $id = $rows['id'];
                                    $images = $rows['image'];
                                    $pro_name = $rows['pro_name'];
                                    $pro_price = $rows['pro_price'];
                                }
                    ?>
                                <div class="swiper-slide">
                                    <a href="productDetail.php?id=<?=$id?>"><img src="Images/productImg/<?=$images ?>" alt="Image"></a>
                                    <p><?=$pro_name?></p>
                                    <p class="reproPrice">$<?=$pro_price?>.00</p>
                                    <a href="productDetail.php?id=<?=$id?>" class="slideBtn">View Detail</a>
                                </div>
                    <?php   
                            }
                        }
                    ?>
                </div>
                <div class="swiper-button-next nextBtn"></div>
                <div class="swiper-button-prev prevBtn"></div>
            </div>
        </div>
        
    </section>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper2 = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 20,
        keyboard: {
          enabled: true,
        },
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        var qty=1;
        var color, size;
        var counter = 0;
        var userId = $("#userId").text();

        $("#quantity").on("input", function() {
            qty = $(this).val();
        //    console.log(qty);
        });

        $(".color button").on("click", function(){
            color =$(this).val();
        //    console.log(color);
        });

        $(".size button").on("click", function(){
            size = $(this).val();
            console.log(size);      
        });
           
        $(".addtoBag").on("click", function(){
            var id = this.id;
        //    console.log(id);
            counter = counter + 1;
            $.ajax({
                url:'cart.php',
                method:'post',
                data:{id:id, userId:userId, qty:qty, color:color, size:size},
                success:function(){
                    if(userId == 0 ) {
                        alert("You can\'t submit this form. Because you didn\'t have an account yet!");
                    }else {
                        alert("Your product is added!");
                        var cartNum = $(".cart_num sup").text();
                        var totalCounter;

                        if(counter != cartNum){
                            totalCounter = parseInt(cartNum) + 1;
                        }else {
                            totalCounter = counter;
                        }
                        $(".cart_num sup").html(totalCounter);
                    }                  
                }
            });
        });

        // Add To favorite
        var favid = $("#favid").text();
        $("#hearts").on("click", function(){
            $.ajax({
                url:'favorite.php',
                method:'post',
                data: {favid:favid, userId:userId},
                success:function(){
                    if(userId == 0 ) {
                        alert("You can\'t add to favorite. Because you didn\'t have an account yet!");
                    }else {
                        alert("Your product is added to favorite!");     
                        $("#hearts").css("display","none");
                        $("#solidHeart").css("display","inline-block");
                    }
                }
            });
        });

        var proName = $("#namepro").text();
        $("#solidHeart").on("click", function(){
            $.ajax({
                url:'favorite.php',
                method:'get',
                data: {proName:proName},
                success:function(){
                    alert("Your product is deleted in favorite!");     
                    $("#solidHeart").css("display","none");
                    $("#hearts").css("display","inline-block"); 
                }
            });
        });

        $(".favcol2 button").on("click", function(){
            var delid = this.id;
        //    console.log(delid);
            $.ajax({
                url:'favorite.php',
                method:'get',
                data: {delid:delid},
                success:function(){
                    alert("Your product is deleted in favorite!");     
                }
            });
        });

    });
    </script>

    <?php include 'footer.php'; ?>
    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <!-- JavaScript File -->
    <script src="js/script.js"></script>

</body>
</html>