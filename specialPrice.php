<?php
    require_once('database.php');
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
    <title>Special Price </title>
    <!-- Ajax Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- CSS File Link -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font awsome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- Bootstrap CND Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <?php include 'header.php'; ?>     
    <section class="specialPrice">
        <div class="pageHeader">
            <div class="back">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="home.php" id="backIcon">BACK</a>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb regiHead_link">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="specialPrice.php">Special Prices</li>
                </ol>
            </nav>
        </div>
        <div class="spContent">
            <h2>A NEW SPECIAL PRICES COLLECTION</h2>
            <p>REFRESH YOUR LOOK FOR THE NEW SEASON WITH OUR DEFINITIVE SPECIAL PRICES COLLECTION FOR WOMEN. DISCOVER CLASSIC COATS, TROUSERS, KNITWEAR, DRESSES AND TOPS ON SALE, AS WELL AS TREND-LED PIECES.</p>
        </div>

        <div class="specialImg">
            <img src="Images/productImg/sepicalImg.webp" alt="Special Pirce Image">
            <div class="specialCont">
                <h2>sale</h2>
                <h3>online and in stores</h3>
                <p>#zarasale #zara_special_prices</p>
                <a href="shop.php">Shop Now</a>
            </div>
        </div>

        <div class="spProducts">
            <div class="row">
            <?php
                $result = db()->query("SELECT * FROM product WHERE discount_prices != 0");
                $num_row = mysqli_num_rows($result);
                if($num_row >0){
                    for($i=1; $i<=$num_row; $i++){
                        if($row = mysqli_fetch_array($result)){
                            $id = $row['id'];
                            $image = $row['image'];
                            $pro_name = $row['pro_name'];
                            $pro_price = $row['pro_price'];
                            $discount_price = $row['discount_prices'];
                        }
            ?>
                        <div class="col">
                            <a href="productDetail.php?id=<?=$id?>"> <img src="Images/productImg/<?=$image?>" alt="picture1"> </a>
                            <p id="spName"><?=$pro_name ?></p>
                            <div class="spItme">
                                <p>$<?=$pro_price?>.00</p>
                                <p id="spPrice">$<?=$discount_price?>.00</p>
                            </div>
                        </div>
            <?php
                        if($i%4 == 0){
                            echo '</div>';
                            echo '<div class="row">';
                        }
                    }
                }
            ?>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
    <script type="text/javascript">
    $(document).ready(function(){
        var name = $("#proName").text();
    //    console.log(name);
        $("#delete_btn").on("click", function(){
            $.ajax({
                url:'favorite.php',
                method:'get',
                data: {proName:name},
                success:function(){
                    alert("Your product is deleted in favorite!");     
                }
            });
        });
    });
    </script>

    <!-- JavaScript File -->
    <script src="js/script.js"></script>
    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>